

// Open a dialog
function openDialog(name) {
  document.querySelector('.' + name).setAttribute('class', name + ' show');
}

// Close a dialog
function closeDialog(name) {
  document.querySelector('.' + name).setAttribute('class', name);
}

