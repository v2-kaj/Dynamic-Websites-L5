const fetchTodos = async (todosList) => {
    try {
        const response = await fetch('all_todos.php');
        const todos = await response.json();
        todosList.innerHTML = '';

        todos.forEach(todo => {

            
            const li = document.createElement('li');
            const span = document.createElement('span');
            span.innerHTML = todo.text;

            // apart from the span of text lets add
            // a hidden input field to edit the text that will be show when the user
            // clicks on the edit button
            // lets also add the delete button

            // finally add the li to the list of all todos

            const editInput = document.createElement('input');
            editInput.type = 'text';
            editInput.value = todo.text;
            editInput.style.display = 'none';

            // Create an edit btn
            const editBtn = document.createElement('button');
            editBtn.innerHTML = 'Edit';

            const saveBtn = document.createElement('button');
            saveBtn.innerHTML = 'Save';
            saveBtn.style.display = 'none';

            //Create a delete buton
            const deleteBtn = document.createElement('button');
            deleteBtn.innerHTML = 'Delete';

            // Edi utton event
            editBtn.addEventListener('click', () => {
                span.style.display = 'none';
                editInput.style.display = 'inline';
                editBtn.style.display = 'none';
                saveBtn.style.display = 'inline';
            });

            // Save butn event
            saveBtn.addEventListener('click', async () => {
                const newText = editInput.value.trim();
                if (newText.length===0) {
                    alert('You forgot to type the task!');
                    return;
                }

                try {
                    const response = await fetch('update_todo.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        // convert the jsobjetc to json since php is expecting a json
                        body: JSON.stringify({ id: todo.id, text: newText })
                    });

                    const result = await response.json();
                    if (result.status === 'succeeded') {
                        span.innerHTML = newText;
                        span.style.display = 'inline';
                        editInput.style.display = 'none';
                        editBtn.style.display = 'inline';
                        saveBtn.style.display = 'none';
                    } else {
                        console.error('Error updating todo:', result.message);
                    }
                } catch (error) {
                    console.error('Error updating todo:', error);
                }
            });

            // Delete button event
            deleteBtn.addEventListener('click', async () => {
                if (confirm('Are you sure you want to delete this todo?')) {
                    try {
                        const response = await fetch('delete_todo.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ id: todo.id })
                        });

                        const result = await response.json();
                        if (result.status === 'succeeded') {
                            fetchTodos(todosList); // Refresh the list
                        } else {
                            console.error('Error deleting todo:', result.message);
                        }
                    } catch (error) {
                        console.error('Error deleting todo:', error);
                    }
                }
            });

            li.appendChild(span);
            li.appendChild(editInput);
            li.appendChild(editBtn);
            li.appendChild(saveBtn);
            li.appendChild(deleteBtn);
            // add the list element to the ol
            todosList.appendChild(li);
        });
    } catch (error) {
        console.error('Error fetching todos:', error);
    }
};


// Starting point

document.addEventListener('DOMContentLoaded', () => {
    const todosList = document.querySelector('#todos');
    const taskInput = document.querySelector('#task');
    
    const form = document.querySelector('form');

    // Fetch todos from the server
    fetchTodos(todosList);


    // Add a todo
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const taskText = taskInput.value.trim();
        if (taskText.length === 0) {
            alert('Please enter a task!');
            return;
        }

        try {
            const response = await fetch('add_todo.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                //convert js object to json
                body: JSON.stringify({ text: taskText })
            });

            // convert the json into js object
            const result = await response.json();
            if (result.status === 'succeeded') {
                taskInput.value = '';
                fetchTodos(todosList);
            } else {
                console.error('Error adding todo:', result.message);
            }
        } catch (error) {
            console.error('Error adding todo:', error);
        }
    });
});
