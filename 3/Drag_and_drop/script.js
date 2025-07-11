document.querySelectorAll(".task").forEach(task => {
    task.addEventListener("dragstart", event => {
        event.dataTransfer.setData("text/plain", event.target.id);
    });
});

document.querySelectorAll("#doing, #done").forEach(target => {
    target.addEventListener("dragover", event => {
        event.preventDefault();
    });

    target.addEventListener("drop", event => {
        event.preventDefault();
        let id = event.dataTransfer.getData("text/plain");
        let draggedElement = document.getElementById(id);
        if (draggedElement) {
            target.appendChild(draggedElement);
        }
    });
});
