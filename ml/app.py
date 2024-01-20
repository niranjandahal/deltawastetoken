from fastapi import FastAPI
from fastapi.responses import JSONResponse
import pandas as pd
import os
import joblib
import json
import requests

app = FastAPI()

# Load the trained model from the pickle file
model_path = os.path.join(os.path.dirname(_file_), 'pricing_model.pkl')
print("Actual model path", model_path)
pricing_model = joblib.load(model_path)

print("Type of pricing_model:", type(pricing_model)) # Debugging statement

# API endpoint to predict prices for all data
@app.get('/predict_all_prices')
def predict_all_prices():
    try:
        # Load data from the JSON file
        response = requests.get('http://192.168.18.36/php/deltawastekon/ml/changedemandandsupplyscript.php')
        print("Response", response)
        data = response.json()
        print("Data", data)

        # Convert the data to a DataFrame
        df = pd.DataFrame(data)
        print("DataFrame",df)
        print("Demand", df["demand"])
        print("Supply", df["supply"])

        # Feature engineering
        df['demand'] = pd.to_numeric(df['demand'], errors='coerce')
        df['supply'] = pd.to_numeric(df['supply'], errors='coerce')
        df['demand_supply_ratio'] = df['demand'] / df['supply']

        df['initial_price'] = df['wasteproduct_price']

        # Extract features for prediction
        x_all = df[['initial_price', 'demand_supply_ratio']]
        print(x_all)

        print("Type of pricing_model before prediction:", type(pricing_model)) # Debugging statement

        # Make predictions for all data
        predicted_prices_all = pricing_model.predict(x_all)

        # Add predicted prices to the DataFrame
        df['predicted_price'] = predicted_prices_all

        # Convert the result to JSON and return
        result = df.to_json(orient='records',default_handler=str)
        # Load the JSON data
        parsed_data = json.loads(result)

        # Create a new JSON file with correct formatting
        with open('corrected_data.json', 'w') as json_file:
            json.dump(parsed_data, json_file, indent=2)

        print("Corrected data saved to 'corrected_data.json'")
        return JSONResponse(content=parsed_data, media_type="application/json")


    except Exception as e:
        return {'error': str(e)}