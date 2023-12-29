function openModal() {
    // Open popup.html in a new window
    const popupWindow = window.open('popup.html', 'Popup', 'width=400, height=300');
    // Focus the new window
    if (popupWindow) {
        popupWindow.focus();
    }
}