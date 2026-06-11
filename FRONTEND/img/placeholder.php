<?php
// FRONTEND/img/placeholder.php
// Retorna uma imagem placeholder em SVG quando a imagem não existe

header('Content-Type: image/svg+xml');
header('Cache-Control: public, max-age=86400');
?>
<svg xmlns="http://www.w3.org/2000/svg" width="300" height="300" viewBox="0 0 300 300">
  <rect width="300" height="300" fill="#E6DED3"/>
  <rect x="50" y="50" width="200" height="200" fill="none" stroke="#A30F06" stroke-width="2" opacity="0.5"/>
  <circle cx="150" cy="110" r="25" fill="#A30F06" opacity="0.3"/>
  <polygon points="80,200 150,120 220,200" fill="#A30F06" opacity="0.3"/>
  <text x="150" y="260" font-family="Arial, sans-serif" font-size="16" fill="#999" text-anchor="middle">Imagem não disponível</text>
</svg>
