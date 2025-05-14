const addres = document.querySelector('#addres');
const slug = document.querySelector('#slug');

addres.addEventListener('change', function(){
    fetch('/dashboard/reqs/checkSlug?addres=' + addres.value)
    .then(response => response.json())
    .then(data => slug.value = data.slug)
});
