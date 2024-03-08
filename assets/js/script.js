document.getElementById('openModal').addEventListener('click', function () {
    document.getElementById('myModal').style.display = 'block';
});
document.getElementById('closeModal').addEventListener('click', function () {
    document.getElementById('myModal').style.display = 'none';
});

function validateForm() {
    var emailInput = document.getElementById('email');
    var phoneInput = document.getElementById('phone');

    if (!emailInput.checkValidity()) {
        alert("Пожалуйста, введите корректный email адрес");
        return false;
    }

    if (!phoneInput.checkValidity()) {
        alert("Пожалуйста, введите корректный номер телефона, начинающийся с +7");
        return false;
    }

    return true;
}