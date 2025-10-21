// qr-generator.js
// Utiliza QRCode.js (https://davidshimjs.github.io/qrcodejs/) para generar QR dinámicamente
// Este archivo asume que QRCode.js está disponible en el mismo directorio o CDN

function showYappyQRDialog(qrData) {
  // Crea el fondo del modal
  let overlay = document.createElement('div');
  overlay.style.position = 'fixed';
  overlay.style.top = '0';
  overlay.style.left = '0';
  overlay.style.width = '100vw';
  overlay.style.height = '100vh';
  overlay.style.background = 'rgba(0,0,0,0.35)';
  overlay.style.display = 'flex';
  overlay.style.alignItems = 'center';
  overlay.style.justifyContent = 'center';
  overlay.style.zIndex = '10000';

  // Crea el dialogo principal
  let dialog = document.createElement('div');
  dialog.style.background = '#fff';
  dialog.style.borderRadius = '14px';
  dialog.style.boxShadow = '0 6px 32px rgba(0,0,0,0.18)';
  dialog.style.padding = '32px 28px 24px 28px';
  dialog.style.minWidth = '320px';
  dialog.style.maxWidth = '95vw';
  dialog.style.textAlign = 'center';
  dialog.style.position = 'relative';

  // Título
  let title = document.createElement('h3');
  title.innerText = 'El Callejon Yappy';
  title.style.margin = '0 0 18px 0';
  title.style.color = '#a3080d';
  title.style.fontWeight = 'bold';
  title.style.fontSize = '1.25rem';
  dialog.appendChild(title);

  // Contenedor QR
  let qrDiv = document.createElement('div');
  qrDiv.id = 'yappy-qr';
  qrDiv.style.display = 'flex';
  qrDiv.style.justifyContent = 'center';
  qrDiv.style.margin = '0 auto 18px auto';
  dialog.appendChild(qrDiv);

  // Botón cerrar
  let closeBtn = document.createElement('button');
  closeBtn.innerText = 'Cerrar';
  closeBtn.style.background = '#a3080d';
  closeBtn.style.color = '#fff';
  closeBtn.style.border = 'none';
  closeBtn.style.borderRadius = '8px';
  closeBtn.style.padding = '8px 32px';
  closeBtn.style.fontSize = '1rem';
  closeBtn.style.cursor = 'pointer';
  closeBtn.style.marginTop = '10px';
  closeBtn.onclick = function() {
    document.body.removeChild(overlay);
  };
  dialog.appendChild(closeBtn);

  overlay.appendChild(dialog);
  document.body.appendChild(overlay);

  // Generar el QR
  new window.QRCode(qrDiv, {
    text: qrData,
    width: 210,
    height: 210,
    colorDark: '#000',
    colorLight: '#fff',
    correctLevel: window.QRCode.CorrectLevel.H
  });
}
window.showYappyQRDialog = showYappyQRDialog;
