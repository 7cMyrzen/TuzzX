// Sélectionner tous les boutons "Ajouter au panier"
document.querySelectorAll('.btn').forEach(button => {
    button.addEventListener('click', () => {
        // Récupérer l'ID du produit depuis l'attribut parent
        const productId = button.closest('.top').id;

        if (productId) {
            // Créer dynamiquement un formulaire
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'index.php?url=ship/addToCart';
            form.style.display = 'none';

            // Ajouter les champs cachés au formulaire
            const inputType = document.createElement('input');
            inputType.type = 'hidden';
            inputType.name = 'form_type';
            inputType.value = 'add_to_cart';
            form.appendChild(inputType);

            const inputId = document.createElement('input');
            inputId.type = 'hidden';
            inputId.name = 'ship_id';
            inputId.value = productId;
            form.appendChild(inputId);

            // Ajouter le formulaire au corps de la page
            document.body.appendChild(form);

            // Soumettre le formulaire
            form.submit();
        } else {
            alert('Erreur : ID du produit introuvable.');
        }
    });
});

const cards = document.querySelectorAll('.cardss');

cards.forEach(card => {
    card.addEventListener('click', () => {
        const id = card.id;
        window.location.href = `index.php?url=ship&id=${id}`;
    });
});


const star1 = document.getElementById('star1');
const star2 = document.getElementById('star2');
const star3 = document.getElementById('star3');
const star4 = document.getElementById('star4');
const star5 = document.getElementById('star5');

const allStars = [
    document.getElementById('star1'),
    document.getElementById('star2'),
    document.getElementById('star3'),
    document.getElementById('star4'),
    document.getElementById('star5')
];

const ratingInput = document.getElementById('ratinginput');


// Au clic, on met toutes les étoiles pleines jusqu'à celle cliquée
allStars.forEach(star => {
    star.addEventListener('click', () => {
        ratingInput.value = star.className;
        allStars.forEach(s => {
            if (s.id <= star.id) {
                s.style.filter = 'grayscale(0%)';
            } else {
                s.style.filter = 'grayscale(100%)';
            }
        });
    });
});
