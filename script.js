document.addEventListener("DOMContentLoaded", function () {
  const apiUrl =
    "http://localhost:8080/D%E1%BB%B1%20%C3%A1n%201%20(TKTW)%20-%20PRO1014/VietNamTravel/VietNamTravel-BE/api/categories";
  const categoryForm = document.getElementById("category-form");
  const categoryName = document.getElementById("category_name");
  const categoryId = document.getElementById("category_id");
  const categoriesDiv = document.getElementById("categories");

  // Lấy dữ liệu
  function fetchCategories() {
    axios
      .get(`${apiUrl}/read.php`)
      .then((response) => {
        const categories = response.data.categories;
        console.log(categories);
        categoriesDiv.innerHTML = "";
        categories.forEach((category) => {
          const categoryItem = document.createElement("div");
          categoryItem.classList.add("category-item");
          categoryItem.innerHTML = `
                          ${category.name}
                          <div>
                              <button onclick="editCategory(${category.category_id}, '${category.name}')">Sửa</button>
                              <button onclick="deleteCategory(${category.category_id})">Xóa</button>
                          </div>
                      `;
          categoriesDiv.appendChild(categoryItem);
        });
      })
      .catch((error) => {
        console.error(error);
      });
  }

  // Thêm và cập nhật danh mục
  categoryForm.addEventListener("submit", function (e) {
    e.preventDefault();
    const id = categoryId.value;
    const name = categoryName.value;

    if (id) {
      // Cập nhật danh mục
      axios
        .put(`${apiUrl}/update.php`, {
          category_id: id,
          category_name: name,
        })
        .then(() => {
          fetchCategories();
          categoryForm.reset();
          categoryId.value = "";
        })
        .catch((error) => {
          console.error(
            "Có lỗi xảy ra khi cập nhật:",
            error.response ? error.response.data : error.message
          );
        });
    } else {
      // Thêm mới danh mục
      axios
        .post(`${apiUrl}/create.php`, { category_name: name })
        .then(() => {
          fetchCategories();
          categoryForm.reset();
        })
        .catch((error) => {
          console.error(
            "Có lỗi xảy ra khi thêm mới:",
            error.response ? error.response.data : error.message
          );
        });
    }
  });

  // Hiển thị thông tin danh mục để chỉnh sửa
  window.editCategory = function (id, name) {
    categoryId.value = id;
    categoryName.value = name;
  };

  // Xóa danh mục
  window.deleteCategory = function (id) {
    if (confirm("Bạn có chắc chắn muốn xóa danh mục này?")) {
      axios
        .delete(`${apiUrl}/delete.php`, {
          data: { category_id: id },
        })
        .then(() => {
          fetchCategories();
        })
        .catch((error) => {
          console.error(
            "Có lỗi xảy ra khi xóa:",
            error.response ? error.response.data : error.message
          );
        });
    }
  };

  // Lấy và hiển thị dữ liệu danh mục ngay khi trang được tải
  fetchCategories();
});
