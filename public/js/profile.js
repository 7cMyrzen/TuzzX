document.addEventListener('DOMContentLoaded', () => {
    const button = document.querySelector('.bottom button');
    const input = document.querySelector('.bottom input');

    button.addEventListener('click', () => {
        const amount = input.value.trim();

        if (!amount || isNaN(amount)) {
            alert('Veuillez entrer un montant valide.');
            return;
        }

        // Préparer les données à envoyer
        const data = new FormData();
        data.append('money', amount);
        data.append('symbol', '+');

        // Envoyer une requête POST à l'URL
        fetch('index.php?url=profile/addMoney', {
            method: 'POST',
            body: data,
        })
            .then((response) => {
                if (response.ok) {
                    alert('Votre solde a été mis à jour.');
                    // Rediriger vers le profil ou actualiser la page
                    window.location.href = 'index.php?url=profile';
                } else {
                    alert('Erreur lors de la mise à jour du solde.');
                }
            })
            .catch((error) => {
                console.error('Erreur :', error);
                alert('Une erreur est survenue.');
            });
    });
});


const deleteButton = document.getElementById('delete');
deleteButton.addEventListener('click', () => {
    let choice = confirm('Voulez-vous vraiment supprimer votre compte ?');
    if (choice) {
        fetch('index.php?url=auth/delete', {
            method: 'POST',
        })
            .then(response => {
                if (response.ok) {
                    alert('Votre compte a été supprimé.');
                    window.location.href = 'index.php?url=home';
                } else {
                    alert('Erreur lors de la suppression du compte.');
                }
            })
            .catch(error => {
                console.error('Erreur :', error);
                alert('Une erreur est survenue.');
            });
    }
});

const modal = document.querySelector(".modal")
const overlay = document.querySelector(".overlay")
const closeBtn = document.querySelector(".close")
const edit = document.querySelector(".editimg")

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

edit.addEventListener('click', () => {
    openModal();
});