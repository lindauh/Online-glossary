const form = document.querySelector("#search-form");
const button = document.querySelector("#search-button");
const input = document.querySelector("#search");

const table = document.querySelector("#result-table");
const tbody = document.querySelector("#result-table").tBodies[0];
const thead = document.querySelector("#result-table").tHead

const translateCheckbox = document.querySelector("#translate-check");
const fulltextCheckbox = document.querySelector("#full-text-check");

const selectedLanguage = document.querySelector("#language");


// search button + description of term
button.addEventListener('click', () => {
    tbody.innerHTML = "";
    thead.innerHTML = "";

    if ((translateCheckbox.checked == false) && (fulltextCheckbox.checked == false)) {
        const data = new FormData(form);

        const th1 = document.createElement("th")
        const th2 = document.createElement("th")
        if (selectedLanguage.value == "sk") {
            th1.innerHTML = "SK";
            th2.innerHTML = "SK description";
        }
        if (selectedLanguage.value == "en") {
            th1.innerHTML = "EN";
            th2.innerHTML = "EN description";
        }

        thead.append(th1);
        thead.append(th2);

        fetch("search.php?search=" + data.get('search') + "&language_code=" + data.get('language_code'), {
            method: "get"
        })
            .then(response => response.json())
            .then(result => {
                result.forEach(item => {
                    const tr = document.createElement("tr");
                    const td1 = document.createElement("td");
                    td1.append(item.searchTerm);
                    const td2 = document.createElement("td")
                    td2.append(item.searchDescription);

                    tr.append(td1);
                    tr.append(td2);
                    tbody.append(tr);
                })
            })
    }
    if ((translateCheckbox.checked == true) && (fulltextCheckbox.checked == false)) {
        const data = new FormData(form);

        const th1 = document.createElement("th");
        const th2 = document.createElement("th");
        const th3 = document.createElement("th");
        const th4 = document.createElement("th");

        if (selectedLanguage.value == "sk") {
            th1.innerHTML = "SK";
            th2.innerHTML = "SK description";
            th3.innerHTML = "EN";
            th4.innerHTML = "EN description";
        }
        if (selectedLanguage.value == "en") {
            th1.innerHTML = "EN";
            th2.innerHTML = "EN description";
            th3.innerHTML = "SK";
            th4.innerHTML = "SK description";
        }

        thead.append(th1);
        thead.append(th2);
        thead.append(th3);
        thead.append(th4);

        fetch("search.php?search=" + data.get('search') + "&language_code=" + data.get('language_code'), {
            method: "get"
        })
            .then(response => response.json())
            .then(result => {
                result.forEach(item => {
                    const tr = document.createElement("tr");
                    const td1 = document.createElement("td");
                    td1.append(item.searchTerm);
                    const td2 = document.createElement("td");
                    td2.append(item.searchDescription);
                    const td3 = document.createElement("td");
                    td3.append(item.translatedTerm);
                    const td4 = document.createElement("td");
                    td4.append(item.translatedDescription);

                    tr.append(td1);
                    tr.append(td2);
                    tr.append(td3);
                    tr.append(td4);
                    tbody.append(tr);
                })
            })
    }

    if ((translateCheckbox.checked == false) && (fulltextCheckbox.checked == true)) {
        const data = new FormData(form);

        const th1 = document.createElement("th");
        const th2 = document.createElement("th");
        if (selectedLanguage.value == "sk") {
            th1.innerHTML = "SK";
            th2.innerHTML = "SK description";
        }
        if (selectedLanguage.value == "en") {
            th1.innerHTML = "EN";
            th2.innerHTML = "EN description";
        }

        thead.append(th1);
        thead.append(th2);

        fetch("search_fulltext.php?search=" + data.get('search') + "&language_code=" + data.get('language_code'), {
            method: "get"
        })
            .then(response => response.json())
            .then(result => {
                result.forEach(item => {
                    const tr = document.createElement("tr");
                    const td1 = document.createElement("td");
                    td1.append(item.searchTerm);
                    const td2 = document.createElement("td");
                    td2.append(item.searchDescription);

                    tr.append(td1);
                    tr.append(td2);
                    tbody.append(tr);
                })
            })
    }

    if ((translateCheckbox.checked == true) && (fulltextCheckbox.checked == true)) {
        const data = new FormData(form);

        const th1 = document.createElement("th");
        const th2 = document.createElement("th");
        const th3 = document.createElement("th");
        const th4 = document.createElement("th");

        if (selectedLanguage.value == "sk") {
            th1.innerHTML = "SK";
            th2.innerHTML = "SK description";
            th3.innerHTML = "EN";
            th4.innerHTML = "EN description";
        }
        if (selectedLanguage.value == "en") {
            th1.innerHTML = "EN";
            th2.innerHTML = "EN description";
            th3.innerHTML = "SK";
            th4.innerHTML = "SK description";
        }

        thead.append(th1);
        thead.append(th2);
        thead.append(th3);
        thead.append(th4);

        fetch("search_fulltext.php?search=" + data.get('search') + "&language_code=" + data.get('language_code'), {
            method: "get"
        })
            .then(response => response.json())
            .then(result => {
                result.forEach(item => {
                    const tr = document.createElement("tr");
                    const td1 = document.createElement("td");
                    td1.append(item.searchTerm);
                    const td2 = document.createElement("td");
                    td2.append(item.searchDescription);
                    const td3 = document.createElement("td");
                    td3.append(item.translatedTerm);
                    const td4 = document.createElement("td");
                    td4.append(item.translatedDescription);

                    tr.append(td1);
                    tr.append(td2);
                    tr.append(td3);
                    tr.append(td4);
                    tbody.append(tr);
                })
            })
    }
})