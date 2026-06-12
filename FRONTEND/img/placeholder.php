<?php

header('Content-Type: image/svg+xml');
header('Cache-Control: public, max-age=86400');
?>
<svg xmlns="http://www.w3.org/2000/svg" width="300" height="300" viewBox="0 0 300 300">
  <rect width="300" height="300" fill="#E6DED3"/>
  <rect x="50" y="50" width="200" height="200" fill="none" stroke="#A30F06" stroke-width="2" opacity="0.5"/>
  
  <polygon points="80,200 150,120 220,200" fill="#A30F06" opacity="0.3"/>
  
  <circle cx="150" cy="110" r="25" fill="#A30F06" opacity="0.3"/>
  
  <g fill="#A30F06" opacity="0.4">
    <path d="M 120,88 C 120,58 180,58 180,88 Z" />
    <path d="M 95,88 C 110,100 190,100 205,88 C 190,78 110,78 95,88 Z" />
  </g>
  
  <polygon points="150,64 152,69 158,69 154,73 156,79 150,75 144,79 146,73 142,69 148,69" fill="#E6DED3" opacity="0.8"/>

  <text x="150" y="260" font-family="Arial, sans-serif" font-size="16" fill="#999" text-anchor="middle">Imagem não disponível</text>
</svg>