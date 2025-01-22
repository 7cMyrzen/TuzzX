const modal = document.querySelector(".modal")
const overlay = document.querySelector(".overlay")
const closeBtn = document.querySelector(".close")
const na = document.querySelector(".na")

function openModal() {
    modal.style.display = "flex";
    overlay.style.display = "flex";
}

function closeModal() {
    modal.style.display = "none";
    overlay.style.display = "none";
}

closeBtn.addEventListener('click', () => {
    closeModal();
});

overlay.addEventListener('click', () => {
    closeModal();
});

na.addEventListener('click', () => {
    openModal();
});


// Récupérer tous les boutons de suppression
const deleteButtons = document.querySelectorAll('.del');

// Ajouter un événement 'click' à chaque bouton
deleteButtons.forEach(button => {
    button.addEventListener('click', (event) => {
        // Récupérer l'ID du produit à supprimer
        const cartId = event.target.id.split('-')[1]; // Extraire l'ID à partir de 'del-id'

        // Appeler la fonction pour supprimer l'élément
        deleteFromCart(cartId);
    });
});

// Fonction pour supprimer l'élément du panier
function deleteFromCart(cartId) {
    // Créer un objet FormData pour envoyer l'ID du produit
    const formData = new FormData();
    formData.append('cartId', cartId);

    // Utiliser fetch pour envoyer la requête de suppression
    fetch('index.php?url=cart/delFromCart', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Vérifier la réponse du serveur
        if (data.success) {
            // Supprimer l'élément de la page
            document.getElementById('del-' + cartId).closest('.elmt').remove();
            window.location.reload();
        } else {
            // Afficher un message d'erreur si la suppression échoue
            alert('Erreur lors de la suppression de l\'article.');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
    });
}

document.addEventListener('DOMContentLoaded', function () {
    // Récupérer tous les boutons d'achat
    const buyButtons = document.querySelectorAll('.buy');
    let selectedAddressId = null;

    // Récupérer tous les boutons radio pour les adresses
    const addressRadioButtons = document.querySelectorAll('input[name="address"]');

    // Lorsque l'utilisateur sélectionne une adresse
    addressRadioButtons.forEach(button => {
        button.addEventListener('change', function (event) {
            selectedAddressId = event.target.id.split('address')[1]; // Extraire l'ID de l'adresse
        });
    });

    // Ajouter un événement 'click' à chaque bouton d'achat
    buyButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            // Récupérer l'ID de l'article
            const itemId = event.target.id.split('-')[1]; // Extraire l'ID de l'article à partir de 'buy-itemId'

            // Vérifier si une adresse a été sélectionnée
            if (selectedAddressId) {
                buyItem(itemId, selectedAddressId);
            } else {
                alert('Veuillez sélectionner une adresse avant de procéder.');
            }
        });
    });

    // Fonction pour acheter un article
    function buyItem(itemId, addressId) {
        // Créer un objet FormData avec l'ID de l'article et de l'adresse
        const formData = new FormData();
        formData.append('itemId', itemId);
        formData.append('addressId', addressId);

        // Utiliser fetch pour envoyer la requête d'achat
        fetch('index.php?url=cart/buyItem', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text()) // Change to .text() for raw response
        .then(data => {
            console.log(data);  // Log raw response to check what is being returned
            try {
                const jsonResponse = JSON.parse(data); // Manually parse JSON if needed
                if (jsonResponse.success) {
                    window.location.href = 'index.php?url=cart';
                } else {
                    alert('Erreur lors de la suppression de l\'article.');
                }
            } catch (error) {
                    console.error('Erreur JSON:', error);
                alert('La réponse du serveur n\'est pas un JSON valide.');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
        });
    }
});
