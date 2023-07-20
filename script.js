function validateForm() {
    const form = document.getElementById('registration');
    const inputs = form.querySelectorAll('input, select');
    let isValid = true;

    inputs.forEach(input => {
        if (input.value.trim() === '') {
            input.classList.add('is-invalid');
            isValid = false;
        } else {
            input.classList.remove('is-invalid');
        }
    });

    if (!isValid) {
        return;
    }

    const formData = $(form).serialize();

    $.ajax({
        type: "POST",
        url: "AddUserData.php",
        data: formData,
        success: function(response) {
            const alertClass = response.includes("uğurla") ? "alert-success" : "alert-danger";
            const alertMessage = `<div class="alert ${alertClass}" role="alert">${response}</div>`;
            $("#resultMessage").html(alertMessage);
        },
        error: function() {
            alert("XƏta baş verdi.");
        }
    });

};

 