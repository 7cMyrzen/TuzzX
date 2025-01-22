const img = document.getElementById('search');
const input = document.getElementById('input');
const searchbar = document.getElementById('input');
const defaultImg = document.getElementById('defaultimg');
const cards = document.querySelectorAll('.card');

img.addEventListener('click', () => {
    if (input.value === '') {
        input.select();
    } else {
        search();
    }
});

searchbar.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        search();
    }
});

function search() {
    showCards();
    const search = input.value;
    //Pour chaque div de class card regarder le span de class name
    cards.forEach(card => {
        const name = card.querySelector('.name').innerText;
        //Si le nom de la carte contient le texte de recherche
        if (name.toLowerCase().includes(search.toLowerCase())) {
            //Alors on affiche la carte
            if (card.style.display === 'flex') {
                card.style.display = 'flex';
            }
        } else {
            //Sinon on cache la carte
            card.style.display = 'none';
        }
    });

    //Si aucune carte ne correspond à la recherche
    if (document.querySelectorAll('.card[style="display: flex;"]').length === 0) {
        //On affiche l'image par défaut
        defaultImg.style.display = 'flex';
    } else {
        //Sinon on cache l'image par défaut
        defaultImg.style.display = 'none';
    }
}

cards.forEach(card => {
    card.addEventListener('click', () => {
        const id = card.id;
        window.location.href = `index.php?url=ship&id=${id}`;
    });
});





const classTuzz = document.getElementById('c1');
const classGiant = document.getElementById('c2');
const classWar = document.getElementById('c3');
const classClassic = document.getElementById('c4');

const allCheckbox = document.getElementById("all");
const otherCheckboxes = [
    document.getElementById("c1"),
    document.getElementById("c2"),
    document.getElementById("c3"),
    document.getElementById("c4")
];

// Gestion du clic sur "Tous"
allCheckbox.addEventListener("change", () => {
    otherCheckboxes.forEach(checkbox => {
        checkbox.checked = allCheckbox.checked;
        showCards();
    });
});

// Gestion du clic sur les autres cases
otherCheckboxes.forEach(checkbox => {
    checkbox.addEventListener("change", () => {
        showCards();
        const allChecked = otherCheckboxes.every(cb => cb.checked);
        allCheckbox.checked = allChecked;
    });
});

function showCards() {
    if (allCheckbox.checked) {
        cards.forEach(card => {
            card.style.display = 'flex';
        });
    } else {
        if (classTuzz.checked) {
            cards.forEach(card => {
                Class = card.querySelector('.category').innerText;
                if (Class=== 'Class Tuzz') {
                    card.style.display = 'flex';
                }
            });
        } else {
            cards.forEach(card => {
                Class = card.querySelector('.category').innerText;
                if (Class === 'Class Tuzz') {
                    card.style.display = 'none';
                }
            });
        }
        if (classGiant.checked) {
            cards.forEach(card => {
                Class = card.querySelector('.category').innerText;
                if (Class === 'Class Giant') {
                    card.style.display = 'flex';
                }
            });
        } else {
            cards.forEach(card => {
                Class = card.querySelector('.category').innerText;
                if (Class === 'Class Giant') {
                    card.style.display = 'none';
                }
            });
        }
        if (classWar.checked) {
            cards.forEach(card => {
                Class = card.querySelector('.category').innerText;
                if (Class === 'Class War') {
                    card.style.display = 'flex';
                }
            });
        } else {
            cards.forEach(card => {
                Class = card.querySelector('.category').innerText;
                if (Class === 'Class War') {
                    card.style.display = 'none';
                }
            });
        }
        if (classClassic.checked) {
            cards.forEach(card => {
                Class = card.querySelector('.category').innerText;
                if (Class === 'Class Classic') {
                    card.style.display = 'flex';
                }
            });
        } else {
            cards.forEach(card => {
                Class = card.querySelector('.category').innerText;
                if (Class === 'Class Classic') {
                    card.style.display = 'none';
                }
            });
        }
    }

    //Si aucune carte ne correspond à la recherche
    if (document.querySelectorAll('.card[style="display: flex;"]').length === 0) {
        //On affiche l'image par défaut
        defaultImg.style.display = 'flex';
    } else {
        //Sinon on cache l'image par défaut
        defaultImg.style.display = 'none';
    }
}