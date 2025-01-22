document.querySelectorAll('.card .ok, .card .ban').forEach(button => {
    button.addEventListener('click', function () {
        const card = this.closest('.card');
        const shipId = card.id; // Récupère l'ID du vaisseau
        const action = this.classList.contains('ok') ? 'accept' : 'delete'; // Détermine l'action

        // URL cible en fonction de l'action
        const url = `index.php?url=/admin/${action}`;

        if (!confirm(`Voulez-vous vraiment ${action} le vaisseau ID: ${shipId} ?`)) {
            return;
        }

        // Envoi de la requête
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: shipId }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Supprime la carte du DOM si supprimé ou accepté
                    card.remove();
                    alert(`Action "${action}" effectuée avec succès pour le vaisseau ID: ${shipId}`);
                } else {
                    alert(`Erreur: ${data.error}`);
                }
            })
            .catch(error => {
                console.error('Erreur lors de la requête:', error);
            });
    });
});
