function submitForm(batch_action)
{
  document.getElementById('batch-action').value = batch_action;
  document.getElementById('adminForm').submit();
}

function checkAll()
{
  // select all item with this class
  // toggle

 var adminForm = document.getElementById('adminForm');

  for (var i = 0 ; adminForm.elements.length > i ; i++) {
    if (adminForm.elements[i].checked == false) {
      adminForm.elements[i].checked = true;
    } else {
     adminForm.elements[i].checked = false;
    }
  }
}