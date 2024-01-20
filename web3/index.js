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
        const minaval   = Math.floor(Math.random() * (1000 - 100 + 1) + 100);
        console.log(minaval)
        const tx = await contract.mint(account, minaval )
        await tx.wait()
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
    
                const burnval   = Math.floor(Math.random() * (1000 - 100 + 1) + 100);
    
                const tx = await contract.burn(burnval);
                await tx.wait();
            } catch (err) {
                console.log(err);
            }
        } else {
            alert("Please install MetaMask");
        }
        window.location.href =   'http://localhost/php/deltawastekon/backendfrontendcombined/sellers/sellerprofile.php';
    }
    
