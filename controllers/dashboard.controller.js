import api from "/config/api.js";
import RowTable from "/views/pages/components/RowTable.js";
import {
  verifyDataTable,
  createDataTable,
} from "/views/pages/components/DataTablesModule.js";

document.addEventListener("DOMContentLoaded", async () => {
  let elementsOnTable = {};
  let defaultAmountElements = 5;
  let amountElements = defaultAmountElements;

  const btnLogout = document.querySelector("#dashboard_btnLogout");

  btnLogout.onclick = () => sign_out();

  const usernameLabel = document.getElementsByClassName("username-label");

  for (const element of usernameLabel) {
    element.innerText = sessionStorage.getItem("name");
  }

  const menus = document.getElementsByClassName("nav-only-item");

  const bodyContent = document.getElementById("mainContent");

  for (const menu of menus) {
    menu.addEventListener("click", async function (evt) {
      evt.preventDefault();
      bodyContent.innerHTML = await renderView(menu.pathname);

      const bodyTable = document.querySelector("#dashboard_table-body");

      if (menu.pathname !== "/dashboard/view/index") {
        let data = (await loadContentTable(menu.pathname)) ?? false;
        verifyDataTable();
        if (data) {
          elementsOnTable = data.result;
          let index = 1;
          for (const product of elementsOnTable) {
            let rowProduct = RowTable(product, index);
            bodyTable.appendChild(rowProduct);
            index++;
          }
        }
        createDataTable();
      }
    });
  }
});

function sign_out() {
  sessionStorage.clear();

  window.location.href = "/sign-out";
}

async function renderView(ref) {
  let res = await api(ref);

  return await res.text();
}

async function loadContentTable(ref) {
  let res = await api("/api" + ref, "GET", null, {
    "x-api-key": sessionStorage.getItem("token"),
  });
  if (res.ok) {
    try {
      let dataJson = await res.json();
      return dataJson;
    } catch (error) {
      return false;
    }
  }
}
