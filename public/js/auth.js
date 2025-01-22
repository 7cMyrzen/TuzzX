const pp = document.getElementById('pp');
const dropdown = document.getElementById('dropdown');

pp.addEventListener('click', () => {
    if (dropdown.style.display === 'flex') {
        dropdown.style.display = 'none';
        return;
    }

    dropdown.style.display = 'flex';
});

document.addEventListener('click', (e) => {
    if (e.target !== pp) {
        dropdown.style.display = 'none';
    }
});
