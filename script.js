// Optional JS for interactivity
document.addEventListener('DOMContentLoaded', () => {
    const featureCards = document.querySelectorAll('.feature-card');

    featureCards.forEach((card) => {
        card.addEventListener('click', () => {
            alert(`You clicked on "${card.querySelector('h3').textContent}"!`);
        });
    });
});
