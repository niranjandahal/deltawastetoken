import { ethers } from "./ethers-5.6.esm.min.js"
import { abi, contractAddress } from "./constants.js"

const connect = document.getElementById("connect")
const mintbutton = document.getElementById("mint")
const burnbutton = document.getElementById("burn")

connect.onclick = connectWallet
mintbutton.onclick = mintfunction
burnbutton.onclick = burnfunction

async function connectWallet() {
    console.log("hello")
    if (typeof window.ethereum !== "undefined") {
      try {
        await ethereum.request({ method: "eth_requestAccounts" })
      } catch (error) {
        console.log(error)
      }
      connect.innerHTML = "Connected"
      const accounts = await ethereum.request({ method: "eth_accounts" })
      console.log(accounts)
    } else {
        connect.innerHTML = "Please install MetaMask"
    }
    
  }

async function mintfunction() {
    console.log("mint func called")
    if (window.ethereum) {
        try {
        const accounts = await window.ethereum.request({
            method: "eth_requestAccounts",
        })
        const account = accounts[0]
        const provider = new ethers.providers.Web3Provider(window.ethereum)
        const signer = provider.getSigner()
        const contract = new ethers.Contract(contractAddress, abi, signer)
        //range 100 to thousand 
        const minaval   = Math.floor(Math.random() * (1000 - 100 + 1) + 100);
        console.log(minaval)
        // const amount = document.getElementById("amount").value
        const tx = await contract.mint(account, minaval )
        await tx.wait()
        // const balance = await contract.balanceOf(account)
        // const balanceElement = document.getElementById("balance")
        // balanceElement.innerHTML = balance.toString()
        } catch (err) {
        console.error(err)
        }
    } else {
        alert("Please install MetaMask")
    }
    window.location.href='http://localhost/php/deltahackathon/WasteKon/BackendFrontendcombine/users/ordereditem.php';
    }


    async function burnfunction() {
        // Burn function to burn tokens
        if (window.ethereum) {
            try {
                const accounts = await window.ethereum.request({
                    method: "eth_requestAccounts",
                });
    
                const account = accounts[0];
                const provider = new ethers.providers.Web3Provider(window.ethereum);
                const signer = provider.getSigner();
                const contract = new ethers.Contract(contractAddress, abi, signer);
    
                // Retrieve the amount to burn (adjust as needed)
                // const amountToBurn = 12112;
                const burnval   = Math.floor(Math.random() * (1000 - 100 + 1) + 100);
    
                // Call the burn function on the smart contract, sending the transaction
                const tx = await contract.burn(burnval);
                await tx.wait();
                // Uncomment the following lines if you want to update and display the balance
                // const balance = await contract.balanceOf(account);
                // const balanceElement = document.getElementById("balance");
                // balanceElement.innerHTML = balance.toString();
            } catch (err) {
                console.log(err);
            }
        } else {
            alert("Please install MetaMask");
        }
        window.location.href =   'http://localhost/php/deltahackathon/WasteKon/BackendFrontendcombine/sellers/sellerprofile.php';
    }