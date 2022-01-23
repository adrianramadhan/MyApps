const UNCOMPLETED_LIST_TODO_ID = "incompleteBookshelfList";
const COMPLETED_LIST_TODO_ID = "completeBookshelfList";
const TODO_ITEMID = "itemid";
const checkbox = document.getElementById("inputBookIsComplete");

let check = false;

checkbox.addEventListener("change", function () {
  if (checkbox.checked) {
    check = true;

    document.querySelector("span").innerText = "Selesai dibaca";
  } else {
    check = false;

    document.querySelector("span").innerText = "Belum selesai dibaca";
  }
});

function addBook() {
  const uncompletedTODOList = document.getElementById(UNCOMPLETED_LIST_TODO_ID);
  const completedTODOList = document.getElementById(COMPLETED_LIST_TODO_ID);
  const bookTitle = document.getElementById("inputBookTitle").value;
  const bookAuthor = document.getElementById("inputBookAuthor").value;
  const bookYear = document.getElementById("inputBookYear").value;
  const isCompleted = document.getElementById("inputBookIsComplete").checked;
  const todo = makeBook(bookTitle, bookAuthor, bookYear, isCompleted);
  const todoObject = composeTodoObject(
    bookTitle,
    bookAuthor,
    bookYear,
    isCompleted
  );

  todo[TODO_ITEMID] = todoObject.id;
  todos.push(todoObject);
  if (isCompleted) {
    completedTODOList.append(todo);
  } else {
    uncompletedTODOList.append(todo);
  }
  updateDataToStorage();
}

function makeBook(dataTitle, dataAuthor, timestamp, isCompleted) {
  const textBookTitle = document.createElement("h2");
  textBookTitle.innerText = dataTitle;

  const textBookAuthor = document.createElement("h3");
  textBookAuthor.innerText = dataAuthor;

  const textBookYear = document.createElement("p");
  textBookYear.innerText = timestamp;

  const textContainer = document.createElement("div");
  textContainer.classList.add("inner");
  textContainer.append(textBookTitle, textBookAuthor, textBookYear);

  const container = document.createElement("div");
  container.classList.add("item", "shadow");
  container.append(textContainer);

  if (isCompleted) {
    container.append(createUndoButton(), createTrashButton());
  } else {
    container.append(createCheckButton(), createTrashButton());
  }

  return container;
}

function createButton(buttonTypeClass, eventListener) {
  const button = document.createElement("button");

  button.classList.add(buttonTypeClass);
  button.addEventListener("click", function (event) {
    eventListener(event);
  });
  return button;
}

function createCheckButton() {
  return createButton("check-button", function (event) {
    addBookToCompleted(event.target.parentElement);
  });
}

function createTrashButton() {
  return createButton("trash-button", function (event) {
    removeBookFromCompleted(event.target.parentElement);
  });
}

function createUndoButton() {
  return createButton("undo-button", function (event) {
    undoBookFromCompleted(event.target.parentElement);
  });
}

function addBookToCompleted(taskElement) {
  const bookTitle = taskElement.querySelector(".inner > h2").innerText;
  const bookAuthor = taskElement.querySelector(".inner > h3").innerText;
  const bookYear = taskElement.querySelector(".inner > p").innerText;
  const newTodo = makeBook(bookTitle, bookAuthor, bookYear, true);
  const todo = findTodo(taskElement[TODO_ITEMID]);
  const listCompleted = document.getElementById(COMPLETED_LIST_TODO_ID);

  todo.isCompleted = true;
  newTodo[TODO_ITEMID] = todo.id;
  listCompleted.insertBefore(newTodo, listCompleted.firstElementChild);
  taskElement.remove();
  updateDataToStorage();
}

function removeBookFromCompleted(taskElement) {
  const todoPosition = findTodoIndex(taskElement[TODO_ITEMID]);
  todos.splice(todoPosition, 1);
  taskElement.remove();
  updateDataToStorage();
}

function undoBookFromCompleted(taskElement) {
  const listUncompleted = document.getElementById(UNCOMPLETED_LIST_TODO_ID);
  const bookTitle = taskElement.querySelector(".inner > h2").innerText;
  const bookAuthor = taskElement.querySelector(".inner > h3").innerText;
  const bookYear = taskElement.querySelector(".inner > p").innerText;
  const newTodo = makeBook(bookTitle, bookAuthor, bookYear, false);
  const todo = findTodo(taskElement[TODO_ITEMID]);

  todo.isCompleted = false;
  newTodo[TODO_ITEMID] = todo.id;
  listUncompleted.append(newTodo);
  taskElement.remove();
  updateDataToStorage();
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
