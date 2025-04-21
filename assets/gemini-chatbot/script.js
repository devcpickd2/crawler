const typingForm = document.querySelector(".typing-form");
const chatContainer = document.querySelector(".chat-list");
const suggestions = document.querySelectorAll(".suggestion");
const toggleThemeButton = document.querySelector("#theme-toggle-button");
const deleteChatButton = document.querySelector("#delete-chat-button");

// State variables
let userMessage = null;
let isResponseGenerating = false;

// API configuration
const API_KEY = "AIzaSyC3IIFDWM3sWDvJFrmss-yuhYVNDG9xzqs"; // Your API key here
const API_URL = `https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=${API_KEY}`;

// Function to save new knowledge to local storage
const saveKnowledgeToLocalStorage = (key, value) => {
	localStorage.setItem(key, value);
};

// Function to retrieve knowledge from local storage
const retrieveKnowledgeFromLocalStorage = (key) => {
	return localStorage.getItem(key) || "";
};

// Load theme and chat data from local storage on page load
const loadDataFromLocalstorage = () => {
	const savedChats = localStorage.getItem("saved-chats");
	const isLightMode = localStorage.getItem("themeColor") === "light_mode";

	// Apply the stored theme
	document.body.classList.toggle("light_mode", isLightMode);
	toggleThemeButton.innerText = isLightMode ? "dark_mode" : "light_mode";

	// Restore saved chats or clear the chat container
	chatContainer.innerHTML = savedChats || "";
	document.body.classList.toggle("hide-header", savedChats);

	chatContainer.scrollTo(0, chatContainer.scrollHeight); // Scroll to the bottom
};

// Create a new message element and return it
const createMessageElement = (content, ...classes) => {
	const div = document.createElement("div");
	div.classList.add("message", ...classes);
	div.innerHTML = content;
	return div;
};

// Show typing effect by displaying words one by one
const showTypingEffect = (text, textElement, incomingMessageDiv) => {
	const words = text.split(" ");
	let currentWordIndex = 0;

	const typingInterval = setInterval(() => {
		// Append each word to the text element with a space
		textElement.innerText +=
			(currentWordIndex === 0 ? "" : " ") + words[currentWordIndex++];
		incomingMessageDiv.querySelector(".icon").classList.add("hide");

		// If all words are displayed
		if (currentWordIndex === words.length) {
			clearInterval(typingInterval);
			isResponseGenerating = false;
			incomingMessageDiv.querySelector(".icon").classList.remove("hide");
			localStorage.setItem("saved-chats", chatContainer.innerHTML); // Save chats to local storage
		}
		chatContainer.scrollTo(0, chatContainer.scrollHeight); // Scroll to the bottom
	}, 75);
};

// Determine if the user's input is related to the stored context
const isRelatedToContext = (message) => {
	const keywords = [
		"cpi",
		"PT Charoen Pokphand Indonesia",
		"CP Food",
		"FIESTA",
		"champ",
		"Food Division",
		"HACCP",
		"BPOM ",
		"Halal",
		"purwoko",
		"digitalisasi industri",
		"naufal",
		"alfurizma",
		"section head",
		"manager digitalisasi industri",
		"IT"
	];
	return keywords.some((keyword) => message.toLowerCase().includes(keyword));
};

// Fetch response from the API based on user message with additional context
const generateAPIResponse = async (incomingMessageDiv) => {
	const textElement = incomingMessageDiv.querySelector(".text");
	const additionalContext =
		retrieveKnowledgeFromLocalStorage("additional-context");

	// Check if the user message is a general question or unrelated to the stored context
	const isGeneralQuestion =
		/hello|hi|morning|afternoon|evening|goodbye|bye|cuaca|weather|temperature|climate|rain|sunny/.test(
			userMessage.toLowerCase()
		);

	// Append additional context only if the message is relevant
	let finalMessage = userMessage;
	if (!isGeneralQuestion && isRelatedToContext(userMessage)) {
		finalMessage = additionalContext + " " + userMessage;
	}

	try {
		const response = await fetch(API_URL, {
			method: "POST",
			headers: { "Content-Type": "application/json" },
			body: JSON.stringify({
				contents: [
					{
						role: "user",
						parts: [{ text: finalMessage }],
					},
				],
			}),
		});

		const data = await response.json();
		if (!response.ok) throw new Error(data.error.message);

		// Get the API response text and remove asterisks from it
		const apiResponse = data?.candidates[0].content.parts[0].text.replace(
			/\*\*(.*?)\*\*/g,
			"$1"
		);
		showTypingEffect(apiResponse, textElement, incomingMessageDiv);
	} catch (error) {
		isResponseGenerating = false;
		textElement.innerText = error.message;
		textElement.parentElement.closest(".message").classList.add("error");
	} finally {
		incomingMessageDiv.classList.remove("loading");
	}
};

// Show a loading animation while waiting for the API response
const showLoadingAnimation = () => {
	const html = `<div class="message-content">
                  <img class="avatar" src="${BASE_URL}assets/gemini-chatbot/images/gemini.svg" alt="Gemini avatar">
                  <p class="text"></p>
                  <div class="loading-indicator">
                    <div class="loading-bar"></div>
                    <div class="loading-bar"></div>
                    <div class="loading-bar"></div>
                  </div>
                </div>
                <span onClick="copyMessage(this)" class="icon material-symbols-rounded">content_copy</span>`;

	const incomingMessageDiv = createMessageElement(html, "incoming", "loading");
	chatContainer.appendChild(incomingMessageDiv);

	chatContainer.scrollTo(0, chatContainer.scrollHeight); // Scroll to the bottom
	generateAPIResponse(incomingMessageDiv);
};

// Copy message text to the clipboard
const copyMessage = (copyButton) => {
	const messageText = copyButton.parentElement.querySelector(".text").innerText;

	navigator.clipboard.writeText(messageText);
	copyButton.innerText = "done"; // Show confirmation icon
	setTimeout(() => (copyButton.innerText = "content_copy"), 1000); // Revert icon after 1 second
};

// Handle sending outgoing chat messages
const handleOutgoingChat = () => {
	userMessage =
		typingForm.querySelector(".typing-input").value.trim() || userMessage;
	if (!userMessage || isResponseGenerating) return; // Exit if there is no message or response is generating

	isResponseGenerating = true;

	const html = `<div class="message-content">
                  <img class="avatar" src="${BASE_URL}assets/gemini-chatbot/images/user.jpg" alt="User avatar">
                  <p class="text"></p>
                </div>`;

	const outgoingMessageDiv = createMessageElement(html, "outgoing");
	outgoingMessageDiv.querySelector(".text").innerText = userMessage;
	chatContainer.appendChild(outgoingMessageDiv);

	typingForm.reset(); // Clear input field
	document.body.classList.add("hide-header");
	chatContainer.scrollTo(0, chatContainer.scrollHeight); // Scroll to the bottom
	setTimeout(showLoadingAnimation, 500); // Show loading animation after a delay
};

// Toggle between light and dark themes
toggleThemeButton.addEventListener("click", () => {
	const isLightMode = document.body.classList.toggle("light_mode");
	localStorage.setItem("themeColor", isLightMode ? "light_mode" : "dark_mode");
	toggleThemeButton.innerText = isLightMode ? "dark_mode" : "light_mode";
});

// Delete all chats from local storage when button is clicked
deleteChatButton.addEventListener("click", () => {
	if (confirm("Are you sure you want to delete all the chats?")) {
		localStorage.removeItem("saved-chats");
		loadDataFromLocalstorage();
	}
});

// Set userMessage and handle outgoing chat when a suggestion is clicked
suggestions.forEach((suggestion) => {
	suggestion.addEventListener("click", () => {
		userMessage = suggestion.querySelector(".text").innerText;
		handleOutgoingChat();
	});
});

// Prevent default form submission and handle outgoing chat
typingForm.addEventListener("submit", (e) => {
	e.preventDefault();
	handleOutgoingChat();
});

// Load data from local storage on page load
loadDataFromLocalstorage();

// Example usage: Save new knowledge to local storage (can be done through a UI or console)
saveKnowledgeToLocalStorage(
	"additional-context",
	`cpi,
  atau PT Charoen Pokphand Indonesia Tbk (Food Division), 
  selanjutnya disebut CP Food, 
  mengembangkan bisnis di bidang industri pengolahan makanan berbahan baku ayam.
  CP Food Indonesia memiliki standar pengolahan produk dengan standar internasional antara lain :
  Pengawasan quality control (QC) yang ketat,
  Menerapkan sistem HACCP (Hazard Analytical Critical Control Point), dan FSSC 22000,
  Diproses dalam suhu terkontrol,
  Diproses dengan mesin pengolahan makanan high technology yang canggih modern Higienis, dengan minimalisasi peran tangan karyawan selama proses.
  Suhu kondisi penyimpanan dan pendistribusian selalu dalam keadaan yang beku,
  Menggunakan daging ayam pilihan dan bahan lainnya,
  Diolah dengan bumbu - bumbu pilihan,
  Fasilitas laboratorium berteknologi tinggi, dengan standar internasional,
  Pengembangan produk yang handal oleh R & D .
  CP Food Indonesia berkomitmen menghasilkan produk-produk berkualitas, maka produk-produk yang dihasilkan sudah memiliki sertifikat dan terdaftar pada:
  Memiliki sertifikat HACCP,
  Sertifikat Halal dari MUI,
  Terdaftar di BPOM (Badan Pengawasan Obat dan Makanan) Dengan Nomor NKV, 
  RPHU (Rumah Potong Hewan Unggas), dan UPD (Usaha Pengolahan Daging).
  CP Food memiliki kantor cabang perwakilan di kota Medan, Palembang, Banten, Jakarta, Bandung, Semarang, Surabaya, Bali, Banjarbaru, dan Makassar. 
  Dengan kualitas produk yang baik, produk GOLDEN FIESTA, FIESTA, FIESTA READY MEAL, FIESTA READY TO SERVE, FIESTA READY TO EAT, FIESTA FRESH EGGS, 
  CHAMP, AKUMO, OKEY, dan ASIMO layak dijadikan makanan pilihan keluarga. Untuk pertanyaan dan saran, 
  konsumen dapat menghubungi layanan konsumen kami pada hari dan jam kerja di nomor (021) 1 500 939.
  digitalisasi industri.
  cpi memiliki divisi digitalisasi industri.
  Manager Digitalisasi Industri adalah Pak Purwoko.
  Section Head digitalisasi industri di Cikande adalah Pak Naufal.
  IT Full Stack Developer digitalisasi industri adalah Alfurizma.`
);
