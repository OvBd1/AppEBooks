function searchBooks() {
    const searchInput = document.querySelector("#searchInput").value;
    const category = document.querySelector("#categorySelect").value;
 
    let url = `https://www.googleapis.com/books/v1/volumes?q=`;
 
    if (searchInput) {
        url += `intitle:${searchInput}`;
    }
 
    if (category) {
        url += `+subject:${category}`;
    }
 
    fetch(url)
        .then(response => response.json())
        .then(data => {
            displayResults(data);
        })
        .catch(error => {
            console.error("Erreur lors de la recherche :", error);
        });
}
 
function displayResults(data) {
    const resultsDiv = document.querySelector("#results");
    resultsDiv.innerHTML = "";
 
    if (data.items && data.items.length > 0) {
        data.items.forEach(item => {
            const cardDiv = document.createElement("div");
            cardDiv.classList.add("card");

            const title = item.volumeInfo.title;
            const authors = item.volumeInfo.authors ? item.volumeInfo.authors.join(", ") : "Auteur inconnu";
            const categories = item.volumeInfo.categories ? item.volumeInfo.categories.join(", ") : "Catégorie inconnue";
            const thumbnail = item.volumeInfo.imageLinks ? item.volumeInfo.imageLinks.thumbnail : "https://via.placeholder.com/128x196?text=Image+non+disponible";
 
            const bookDiv = document.createElement("div");
            bookDiv.innerHTML = `
                <h2>${title}</h2>
                <img src="${thumbnail}" alt="${title}" style="width: 128px; height: 196px;">
                <p>Auteur(s): ${authors}</p>
                <p>Catégorie(s): ${categories}</p>
                <button class='favorite'>Ajouter aux favoris</button>
               
            `;
 
            resultsDiv.appendChild(bookDiv);
        });
    } else {
        resultsDiv.innerHTML = "<p>Aucun livre trouvé.</p>";
    }
}