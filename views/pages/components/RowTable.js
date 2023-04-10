

function RowTable (data, index) {
  const newRow = document.createElement("tr");

  const frament = document.createDocumentFragment();


  Object.keys(data).forEach((key) => {
    if(key !== 'DESCRIPCION'){
        const dataTable = document.createElement("td")
        const spanText = document.createElement("span")
        spanText.className = "fw-normal"
        spanText.innerText = key === 'PR_ID'  ? index : data[key]
        dataTable.append(spanText)
        newRow.appendChild(dataTable)
        
    }
  });

  const options = document.createElement("td");

  options.innerHTML = `
    <button class="btn btn-info" type="button">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
    </svg>
</button>
<button class="btn btn-danger" type="button">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
    </svg>
</button>
    `

  newRow.appendChild(options);
  return newRow
}

export default RowTable