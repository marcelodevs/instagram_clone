document.getElementById('bio-text').addEventListener('input', function () {
  const maxLength = 0;
  const currentLength = this.value.length;
  const remaining = maxLength + currentLength;
  const charCount = document.getElementById('char-count');

  charCount.textContent = remaining;

  if (remaining >= 140) charCount.style.color = 'red';
  else charCount.style.color = '';
});

document.querySelector('.altera-foto').addEventListener('click', (e) => {
  e.preventDefault();
  var inp_file = document.querySelector('.img-up');
  inp_file.type = 'file';
  inp_file.click();
});

const form = document.querySelector('.conteudo-geral form');
const submitBtn = document.getElementById('submitBtn');

const originalFormData = new FormData(form);
let isFormModified = false;

form.addEventListener('input', () => {
  const currentFormData = new FormData(form);

  for (const [key, value] of currentFormData.entries())
  {
    if (value !== originalFormData.get(key))
    {
      isFormModified = true;
      break;
    }
  }

  if (isFormModified)
  {
    submitBtn.disabled = false;
  } else
  {
    submitBtn.disabled = true;
  }
});
