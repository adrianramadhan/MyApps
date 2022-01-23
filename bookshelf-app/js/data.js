const STORAGE_KEY = "TODO_APPS";

let todos = [];

function isStorageExist() {
  if (typeof storage === undefined) {
    alert("Browser kamu tidak mendukung Local Storage");
    return false;
  }
  return true;
}

function saveData() {
  const parsed = JSON.stringify(todos);
  localStorage.setItem(STORAGE_KEY, parsed);
  document.dispatchEvent(new Event("ondatasaved"));
}

function loadDataFromStorage() {
  const serializedData = localStorage.getItem(STORAGE_KEY);

  let data = JSON.parse(serializedData);

  if (data !== null) todos = data;

  document.dispatchEvent(new Event("ondataloaded"));
}

function updateDataToStorage() {
  if (isStorageExist()) saveData();
}

function composeTodoObject(bookTitle, bookAuthor, bookYear, isCompleted) {
  return {
    id: +new Date(),
    bookTitle,
    bookAuthor,
    bookYear,
    isCompleted,
  };
}

function refreshDataFromTodos() {
  const listUncompleted = document.getElementById(UNCOMPLETED_LIST_TODO_ID);
  let listCompleted = document.getElementById(COMPLETED_LIST_TODO_ID);

  for (let todo of todos) {
    const newTodo = makeBook(
      todo.bookTitle,
      todo.bookAuthor,
      todo.bookYear,
      todo.isCompleted
    );
    newTodo[TODO_ITEMID] = todo.id;

    if (todo.isCompleted) {
      listCompleted.append(newTodo);
    } else {
      listUncompleted.append(newTodo);
    }
  }
}

function findTodo(todoId) {
  for (let todo of todos) {
    if (todo.id === todoId) return todo;
  }
  return null;
}

function findTodoIndex(todoId) {
  let index = 0;
  for (let todo of todos) {
    if (todo.id === todoId) return index;

    index++;
  }

  return -1;
}
