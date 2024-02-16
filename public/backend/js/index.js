
const tableList = document.querySelector("#myTable");
const deleteForm = document.querySelector(".delete-form");
if (tableList) {
    tableList.addEventListener("click", function (e) {
        if (e.target.classList.contains("delete-action")) {
            e.preventDefault();
            Swal.fire({
                title: "Bạn có muốn xóa không?",
                text: "Nếu xóa sẽ không khôi phục được!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Có",
            }).then(function (result) {
                if (result.value) {
                    const action = e.target.href;
                    deleteForm.action = action;
                    deleteForm.submit();
                }
            });
        }
    });
}

function createSlug(string) {
    const search = [
        /(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g,
        /(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g,
        /(ì|í|ị|ỉ|ĩ)/g,
        /(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g,
        /(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g,
        /(ỳ|ý|ỵ|ỷ|ỹ)/g,
        /(đ)/g,
        /(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/g,
        /(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/g,
        /(Ì|Í|Ị|Ỉ|Ĩ)/g,
        /(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/g,
        /(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/g,
        /(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/g,
        /(Đ)/g,
        /[^a-zA-Z0-9\-\_]/g,
    ];

    const replace = [
        "a",
        "e",
        "i",
        "o",
        "u",
        "y",
        "d",
        "A",
        "E",
        "I",
        "O",
        "U",
        "Y",
        "D",
        "-",
    ];

    let result = string;

    for (let i = 0; i < search.length; i++) {
        result = result.replace(search[i], replace[i]);
    }
    result = result.replace(/(-)+/g, "-");
    result = result.toLowerCase();
    return result;
}

const title = document.querySelector(".title");
const slug = document.querySelector(".slug");
let isChangeSlug = false;
if (slug.value === "") {
    title.addEventListener("input", function (e) {
        if (!isChangeSlug) {
            const string = e.target.value;
            slug.value = createSlug(string);
        }
    });
}

slug.addEventListener("keyup", function (e) {
    if (e.target.value === "") {
        const string = title.value;
        slug.value = createSlug(string);
    }
    isChangeSlug = true;
});

const logoutAction = document.querySelector(".logout-action");
const logoutForm = document.querySelector(".logout-form");
logoutAction.addEventListener("click", function () {
    logoutForm.submit();
});
