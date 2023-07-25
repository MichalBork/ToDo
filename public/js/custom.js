document.addEventListener('DOMContentLoaded', (event) => {
    const checkboxes = document.querySelectorAll(".task-checkbox");

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function(e) {
            const itemName = e.target.nextElementSibling;

            if (this.checked) {
                itemName.outerHTML = `<s class="item-name">${itemName.textContent}</s>`;
            } else {
                itemName.outerHTML = `<span class="item-name">${itemName.textContent}</span>`;
            }

            const taskId = this.id;

            const taskStatus = this.checked;
            console.log(taskId, taskStatus);
            fetch(`/end-task/${taskId}/${taskStatus}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
            }).then(response => response.json())
                .then(data => console.log(data))
                .catch((error) => {
                    console.error('Error:', error);
                });
        });
    });
});
