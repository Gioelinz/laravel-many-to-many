const urlInput = document.getElementById('image');
const img = document.querySelector('.preview');
const currentValue = urlInput.value;
const placeholder = 'https://icons.iconarchive.com/icons/ccard3dev/dynamic-yosemite/1024/Preview-icon.png'

if (currentValue) img.setAttribute('src', currentValue)
else img.setAttribute('src', placeholder)

urlInput.addEventListener('change', function () {
    const urlValue = urlInput.value;
    if (!urlValue) img.setAttribute('src', placeholder);
    else img.setAttribute('src', urlValue);
})