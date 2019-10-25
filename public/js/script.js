
// Sidebars
function openLeftMenu(menuID, contentID) {
    let leftMenu = document.getElementById(menuID);
    let content  = document.getElementById(contentID);
    addMultipleClasses(content, ['hidden']);
    removeMultipleClasses(leftMenu, ['hidden']);
}

function closeLeftMenu(menuID, contentID) {
    let leftMenu = document.getElementById(menuID);
    let content  = document.getElementById(contentID);
    addMultipleClasses(leftMenu, ['hidden']);
    removeMultipleClasses(content, ['hidden']);
}
// filter
function toggleDropDownFilter() {

    let filter       = document.getElementById('filter'),
        results      = document.getElementById('results'),
        searchFilter = document.getElementById('search-filter'),
        searchInput  = document.getElementById('search-input');
    if(filter.style.display === "flex") {

        filter.style.height = "0";
        filter.style.display = "none";
        results.style.top = "0";
        searchFilter.style.backgroundColor = "#FFF";
        searchInput.style.backgroundColor = "#FFF";
        searchFilter.style.color = ""
        searchInput.style.borderBottom = "0px";
    } else {

        filter.style.height = "400px";
        filter.style.display = "flex";
        results.style.top = "400px";
        searchFilter.style.backgroundColor = "#1A202C";
        searchFilter.style.color = "#ACBBE2";
        searchInput.style.backgroundColor = "#1A202C";
        searchInput.style.borderBottom = "2px solid #ACBBE2";
    }
}

function showReviewsTab()
{
    let specifications = document.getElementById('specifications');
    let specificationsTab = document.getElementById('specifications-tab');
    let reviews = document.getElementById('reviews');
    let reviewsTab = document.getElementById('reviews-tab');

    addMultipleClasses(specifications,  ['hidden']);
    removeMultipleClasses(specificationsTab, ['text-oxford']);
    addMultipleClasses(specificationsTab, ['text-heather']);

    removeMultipleClasses(reviews,  ['hidden']);
    removeMultipleClasses(reviewsTab, ['text-heather']);
    addMultipleClasses(reviewsTab, ['text-oxford']);
}

function showSpecificationsTab()
{
    let specifications = document.getElementById('specifications');
    let specificationsTab = document.getElementById('specifications-tab');
    let reviews = document.getElementById('reviews');
    let reviewsTab = document.getElementById('reviews-tab');

    addMultipleClasses(reviews,  ['hidden'])
    removeMultipleClasses(reviewsTab, ['text-oxford']);
    addMultipleClasses(reviewsTab, ['text-heather']);

    removeMultipleClasses(specifications,  ['hidden']);
    removeMultipleClasses(specificationsTab, ['text-heather']);
    addMultipleClasses(specificationsTab, ['text-oxford']);
}

function addMultipleClasses(element, classes) {
    for (let i = 0; i < classes.length; i++)
        element.classList.add(classes[i]);
}

function removeMultipleClasses(element, classes) {
    for (let i = 0; i < classes.length; i++)
        element.classList.remove(classes[i]);
}

function addGroups() {
    let count = document.getElementById('groups-count').value;
    if (count >= 1) {
        let container = document.getElementById('specification-groups');


        while (container.hasChildNodes()) {
            container.removeChild(container.lastChild);
        }

        for (let i = 0; i < count; i++) {
            let nameFieldDiv = document.createElement("div");
            nameFieldDiv.classList += "form-control";
            let nameLabel = document.createElement('label');
            nameLabel.innerText = "Group name";
            let input = document.createElement("input");
            input.type = "text";
            input.name = "groups[" + i + "][name]";
            nameFieldDiv.append(nameLabel);
            nameFieldDiv.append(input);
            let groupNumber = document.createElement('p');
            addMultipleClasses(groupNumber, ['text-oxford', 'font-bold']);
            groupNumber.innerText = "Group " + i;
            container.appendChild(groupNumber);
            container.appendChild(nameFieldDiv);

            let specificationFieldDiv = document.createElement("div");
            addMultipleClasses(specificationFieldDiv, ['form-control']);

            let specificationCountLabel = document.createElement('label');
            specificationCountLabel.innerText = "# of specifications";
            let specificationsCount = document.createElement("input");
            specificationsCount.type = "number";
            specificationsCount.id = "specifications-count" + i;
            specificationFieldDiv.append(specificationCountLabel);
            specificationFieldDiv.append(specificationsCount);
            container.appendChild(specificationFieldDiv);

            let button = document.createElement("p");
            button.innerText = "Show";
            button.id = "button" + i;

            let specifications = document.createElement("div");
            specifications.name = "specifications-div" + i;
            specifications.id = "specifications-div" + i;


            button.onclick = function () {
                let count = specificationsCount.value;

                while (specifications.hasChildNodes()) {
                    specifications.removeChild(specifications.lastChild);
                }
                if (count >= 1) {
                    for(let x = 0; x < count; x++ ) {
                        let div = document.createElement('div');
                        div.classList = "form-control";
                        let label = document.createElement('label');
                        label.innerText = "Specification " + x;

                        let input = document.createElement("input");
                        input.type = "text";
                        input.name = "groups[" + i + "][specifications][" + x + "]";
                        div.append(label);
                        div.append(input);
                        specifications.appendChild(div);
                    }
                }
            };

            container.appendChild(button);


            container.appendChild(specifications);
            container.appendChild(document.createElement("br"));
        }
    }
}

function addImagesFields() {
    let imagesCount = parseInt(document.getElementById('images-count').value);
    let container   = document.getElementById('images-div');
    container.innerHTML = "";
    if (imagesCount >= 1) {
        for (let i=0; i < imagesCount; i++) {
            let imageDiv = document.createElement("div");
            let imageLabel = document.createElement('label');
            imageLabel.innerText = "Image " + (i +1);
            imageLabel.for = "image-" + (i + 1);
            imageDiv.appendChild(imageLabel);

            let imageField = document.createElement("input");
            imageField.type = "file";
            imageField.name = "images[" + (i + 1) + "]";
            imageField.id = "image-" + (i + 1);
            imageDiv.appendChild(imageField);

            container.appendChild(imageDiv);
        }
    }
}

function displayModal(modalID) {
    let modal = document.getElementById(modalID).parentElement;
    removeMultipleClasses(modal, ['hidden']);
    addMultipleClasses(modal, ['absolute', 'z-10']);
}

function closeModal(modalID) {
    let modal = document.getElementById(modalID).parentElement;
    addMultipleClasses(modal, ['hidden']);
    removeMultipleClasses(modal, ['absolute', 'z-10']);
}

//AJAX
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function deleteSpecification(id) {
    $.ajax({
        type: 'delete',
        url: '/admin/specifications/' + id + '/delete',
        success: function (groups) {
            location.reload();
        }
    })
}

function deleteGroup(id) {
    $.ajax({
        type: 'delete',
        url: '/admin/specificationGroups/' + id + '/delete',
        success: function () {
            location.reload();
        }
    })
}

function showSpecifications(e) {
    let categoryID = $(e).val();
    let container = $('#item-specification-dev');
    container.empty();
    $.ajax({
        type: 'get',
        url: "/categories/" + categoryID + "/ajax",
        success: function(response) {
            for(let i = 0; i < response.length; i++) {
                let groupID = response[i].id;
                let formGroup = document.createElement('div');
                formGroup.classList += "form-group";
                let header = document.createElement('p');
                addMultipleClasses(header, ["m-15", "text-oxford", "font-bold"]);
                header.innerText = response[i].group_name;
                $.ajax({
                    type: 'get',
                    url: '/specifications/' + groupID + '/ajax',
                    success: function (specifications) {
                        for(let x = 0; x < specifications.length; x++) {
                            let formControl = document.createElement('div');
                            formControl.classList += "form-control";

                            let label = document.createElement('label');
                            label.innerText = specifications[x].name;

                            label.htmlFor = "specifications[" + specifications[x].id + "]";

                            let input = document.createElement('input');
                            input.name = "specifications[" + specifications[x].id + "]";
                            input.id = "specifications[" + specifications[x].id + "]";
                            input.type = "text";

                            formControl.append(label);
                            formControl.append(input);

                            formGroup.append(formControl);
                        }
                        container.append(header);
                        container.append(formGroup);
                    }
                })
            }
        }
    })
};


