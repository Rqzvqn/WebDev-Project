function displayCreateList(userId) {
    const formContainer = document.createElement('section');
    formContainer.className = 'container mb-5';
    formContainer.id = 'formContainer';

    const title = document.createElement('h4');
    title.innerText = 'Create a new List';

    const createListForm = document.createElement('form');
    createListForm.method = 'POST';
    createListForm.className = 'mt-4';

    const formGroupName = document.createElement('section');
    formGroupName.className = 'form-group'

    const nameInput = document.createElement('input');
    nameInput.type = 'text';
    nameInput.name = 'name';
    nameInput.placeholder = 'Enter list name';
    nameInput.id = 'createListName';
    nameInput.className = 'form-control mb-3';

    const formGroupDescription = document.createElement('section');
    formGroupDescription.className = 'form-group';

    const descriptionInput = document.createElement('input')
    descriptionInput.type = 'text';
    descriptionInput.name = 'description';
    descriptionInput.placeholder = 'Enter list description';
    descriptionInput.id = 'createListDescription';
    descriptionInput.className = 'form-control mb-3';

    const formGroupButtons = document.createElement('section');
    formGroupButtons.className = 'form-group d-flex justify-content-between';

    const createListButton = document.createElement('button');
    createListButton.name = 'createNewList';
    createListButton.type = 'button';
    createListButton.className = 'btn btn-success btn-sm';
    createListButton.innerText = 'Create';
    createListButton.style.width = '45%';
    createListButton.addEventListener('click', (event) => {
        createGameList(userId);
    })

    const cancelListButton = document.createElement('button');
    cancelListButton.name = 'cancelCreateList';
    cancelListButton.type = 'button';
    cancelListButton.className = 'btn btn-outline-danger btn-sm'
    cancelListButton.innerText = 'Cancel';
    cancelListButton.style.width = '45%';
    cancelListButton.addEventListener('click', (event) => {
        cancelCreateList();
    })

    formGroupName.appendChild(nameInput);
    formGroupDescription.appendChild(descriptionInput);
    formGroupButtons.append(cancelListButton, createListButton);
    createListForm.append(formGroupName, formGroupDescription, formGroupButtons);
    formContainer.append(title, createListForm);

    const createNewListSection = document.createElement('section');
    createNewListSection.id = 'createNewListSection';
    createNewListSection.className = 'mb-3 col-sm-11 col-md-8 col-lg-6 col-xl-4 m-auto my-5 text-center h-50';
    createNewListSection.appendChild(formContainer);

    const myListsContainer = document.getElementById('myLists-container');
    const tableSection = document.getElementById('tableSection');

    cancelCreateList();
    myListsContainer.insertBefore(createNewListSection, tableSection);
}

function cancelCreateList() {
    if (document.body.contains(document.getElementById('createNewListSection'))) {
        const createNewListSection = document.getElementById('createNewListSection');
        createNewListSection.remove();
    }
}

function displayGameLists(gameLists) {
    const gameListsTableBody = document.getElementById('gameListsTableBody');

    if (Object.keys(gameLists).length < 1) {
        const noListsSection = document.createElement('section');

        const noListsMessage = document.createElement('p');
        noListsMessage.className = 'text-danger';
        noListsMessage.innerHTML = "It seems like you don't have any lists yet...";

        noListsSection.appendChild(noListsMessage);
        gameListsTableBody.appendChild(noListsSection);

    } else {
        gameLists.forEach(
            gameList => {
                const tr = document.createElement('tr');

                const nameTh = document.createElement('th');
                nameTh.innerHTML = gameList.name;
                nameTh.style.cursor = 'pointer';
                nameTh.addEventListener('click', (event) => {
                    window.location.href = `mylistdetails?name=${gameList.name}&id=${gameList.gameListId}`;
                })

                const descriptionTd = document.createElement('td');
                descriptionTd.innerHTML = gameList.description;
                descriptionTd.style.cursor = 'pointer';
                descriptionTd.addEventListener('click', (event) => {
                    window.location.href = `mylistdetails?name=${gameList.name}&id=${gameList.gameListId}`;
                })

                const buttonTd = document.createElement('td');

                const deleteButton = document.createElement('button');
                deleteButton.className = 'btn btn-danger d-flex px-2 py-2 mx-auto';
                deleteButton.addEventListener('click', (event) => {
                    void deleteGameList(gameList.gameListId, gameList.name);
                });

                const trashCanIcon = document.createElement('i');
                trashCanIcon.className = 'fas fa-trash-can';

                deleteButton.appendChild(trashCanIcon);
                buttonTd.appendChild(deleteButton);
                tr.append(nameTh, descriptionTd, buttonTd);
                gameListsTableBody.appendChild(tr);
            }
        )
    }
}

function getUserId() {
    return fetch(`api/myLists/getUserId`)
        .then(res => res.json())
        .then(data => {
            return data
        });
}

function getGameListsForUser(userId) {
    if (document.body.contains(document.getElementById('gameListsTableBody')))
        document.getElementById('gameListsTableBody').innerHTML = "";


    fetch(`api/mylists/getListsByUserId/${userId}`)
        .then(res => res.json())
        .then((data) => {
            displayGameLists(data, userId);
        })
        .catch((err) => console.error(err));
}

function createGameList(userId) {
    const listName = document.getElementById('createListName');
    const listDescription = document.getElementById('createListDescription');

    const data = {
        'name': listName.value,
        'description': listDescription.value
    }


    fetch('api/mylists/createGameList', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
        .then(output => {
            listName.value = null;
            listDescription.value = null;
            getGameListsForUser(userId);
            cancelCreateList();
        })
        .catch(err => console.error(err));
}

async function deleteGameList(gameListId, gameListName) {
    if (confirm(`Are you sure you want to delete ${gameListName}?`)) {
        const userId = await getUserId();

        const url = `api/myLists/deleteGamelist/${gameListId}`
        fetch(url, {
            method: 'DELETE',
        })
            .then(output => {
                getGameListsForUser(userId);
            })
            .catch(err => console.error(err));
    }
}


function getMgamesForList(gameListId, gameListName) {
    if (document.body.contains(document.getElementById('detailsTableBody')))
        document.getElementById('detailsTableBody').innerHTML = "";

    fetch(`api/myLists/getMgamesByGameListId/${gameListId}`)
        .then(res => res.json())
        .then((data) => {
            displayMgames(data, gameListId, gameListName);
        })
        .catch((err) => console.error(err));
}

function displayMgames(mgames, gameListId, gameListName) {
    const detailsTableBody = document.getElementById('detailsTableBody');

    mgames.forEach(
        mgame => {
            const tr = document.createElement('tr');

            const typeTd = document.createElement('td');
            typeTd.id = 'mgameIconTd';
            const mgameIcon = document.createElement('i');
            mgameIcon.className = 'fas fa-gamepad';

            const titleTh = document.createElement('th');
            titleTh.innerHTML = mgame.title;

            const creatorTd = document.createElement('td');
            creatorTd.id = 'mgameCreatorTd';
            creatorTd.innerHTML = mgame.creator;

            const mpriceTd = document.createElement('td');
            mpriceTd.innerHTML = `${mgame.mprice} €`;

            const buttonTd = document.createElement('td');

            const deleteButton = document.createElement('button');
            deleteButton.className = 'btn btn-danger d-flex px-2 py-2 mx-auto';
            deleteButton.addEventListener('click', (event) => {
                removeFromList(mgame.itemId, gameListId, mgame.title, gameListName);
            });

            const trashCanIcon = document.createElement('i');
            trashCanIcon.className = 'fas fa-trash-can';

            typeTd.appendChild(mgameIcon);
            deleteButton.appendChild(trashCanIcon);
            buttonTd.appendChild(deleteButton);
            tr.append(typeTd, titleTh, creatorTd, mpriceTd, buttonTd);
            detailsTableBody.appendChild(tr);
        }
    )
}

function getSgamesForList(gameListId, gameListName) {
    if (document.body.contains(document.getElementById('detailsTableBody')))
        document.getElementById('detailsTableBody').innerHTML = "";

    fetch(`api/myLists/getSgamesByGameListId/${gameListId}`)
        .then(res => res.json())
        .then((data) => {
            displaySgames(data, gameListId, gameListName);
        })
        .catch((err) => console.error(err));
}

function displaySgames(sgames, gameListId, gameListName) {
    const detailsTableBody = document.getElementById('detailsTableBody');

    sgames.forEach(
        sgame => {
            const tr = document.createElement('tr');
            tr.id = 'mgamesRow';
            tr.style.padding = '5rem';

            const typeTd = document.createElement('td');
            typeTd.id = 'sgameIconTd';
            const sgameIcon = document.createElement('i');
            sgameIcon.className = 'fas fa-user';

            const titleTh = document.createElement('th');
            titleTh.innerHTML = sgame.title;

            const creatorTd = document.createElement('td');
            creatorTd.id = 'sgameCreatorTd';
            creatorTd.innerHTML = sgame.creator;

            const spriceTd = document.createElement('td');
            spriceTd.innerHTML = `${sgame.sprice}€`;


            const buttonTd = document.createElement('td');

            const deleteButton = document.createElement('button');
            deleteButton.className = 'btn btn-danger d-flex px-2 py-2 mx-auto';
            deleteButton.addEventListener('click', (event) => {
                removeFromList(sgame.itemId, gameListId, sgame.title, gameListName);
            });

            const trashCanIcon = document.createElement('i');
            trashCanIcon.className = 'fas fa-trash-can';

            typeTd.appendChild(sgameIcon);
            deleteButton.appendChild(trashCanIcon);
            buttonTd.appendChild(deleteButton);
            tr.append(typeTd, titleTh, creatorTd, spriceTd, buttonTd);
            detailsTableBody.appendChild(tr);
        }
    )
}

function addToList(itemId, gameListId) {
    const data = {
        'gameListId': gameListId,
        'itemId': itemId
    }

    fetch('api/mylists/addToList', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
        .then(output => {
            alert(`Successfully added to list`);
        })
        .catch(err => console.error(err));
}

function removeFromList(itemId, gameListId, itemTitle, gameListName) {
    if (confirm(`Are you sure you want to remove ${itemTitle} from ${gameListName}?`)) {
        const url = 'api/myLists/removeFromList';

        const data = {
            'gameListId': gameListId,
            'itemId': itemId
        }

        fetch(url, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data),
        })
            .then(output => {
                getMgamesForList(gameListId);
                getSgamesForList(gameListId);
            })
            .catch(err => console.log(err));
    }
}
