console.log("take_quiz.js LOADED");

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('quizForm');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('../../actions/submit_quiz.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            console.log(data);

            if (data.success) {
                document.getElementById('quizResult').innerHTML = `
                    <h3>Résultat</h3>
                    <p>Score: ${data.score} / ${data.total}</p>
                    <p>Pourcentage: ${data.percent}%</p>
                `;
            } else {
                alert(data.message);
            }
        })
        .catch(err => console.error(err));
    });
});
