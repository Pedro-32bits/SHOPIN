
// Gatinho CPF 🐾
function mascaraCPF(campo) {
  let value = campo.value.replace(/\D/g, '');
  value = value.substring(0, 11);
  if (value.length > 3) value = value.replace(/(\d{3})(\d)/, '$1.$2');
  if (value.length > 6) value = value.replace(/(\d{3})(\d{3})(\d)/, '$1.$2.$3');
  if (value.length > 9) value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
  campo.value = value;
}

// Gatinho Telefone 🐾
function mascaraTelefone(campo) {
  let value = campo.value.replace(/\D/g, '');
  value = value.substring(0, 11);
  if (value.length > 2) value = value.replace(/(\d{2})(\d)/, '($1) $2');
  if (value.length > 7) value = value.replace(/(\d{5})(\d)/, '$1-$2');
  campo.value = value;
}

// Função para limpar os campos antes de enviar
function limparFormulario(form) {
  form.cpf.value = form.cpf.value.replace(/\D/g, '');
  form.telefone.value = form.telefone.value.replace(/\D/g, '');
}   