<?php
// Determinar se estamos em uma subpasta
$em_subpasta = (strpos($_SERVER['PHP_SELF'], '/cliente/') !== false || 
                 strpos($_SERVER['PHP_SELF'], '/vendedor/') !== false ||
                 strpos($_SERVER['PHP_SELF'], '/admin/') !== false);

// Determinar o prefixo correto para os caminhos
$prefix = $em_subpasta ? '../' : '';
?>
<footer class="bg-white/90 py-12 border-t-4 border-[#A30F06] mt-20">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center md:text-left">
            
            <div class="space-y-4">
                <div class="flex justify-center md:justify-start items-center space-x-2">
                    <img src="<?php echo $prefix; ?>img/logo.png" alt="Logo" class="h-12 w-auto object-contain">
                    <h2 class="font-cordel text-[#A30F06] text-3xl">SHOPIN A</h2>
                </div>
                <p class="text-sm font-bold text-gray-600 uppercase tracking-[0.2em] leading-relaxed">
                    A Nossa gente <br> compra aqui!
                </p>
                <div class="flex justify-center md:justify-start space-x-4 text-[#A30F06]">
                    <a href="https://www.instagram.com/shopinn_.a?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" class="hover:scale-110 transition-transform" title="Instagram"><i class="fab fa-instagram text-2xl"></i></a>
                    <a href="https://www.facebook.com" target="_blank" class="hover:scale-110 transition-transform" title="Facebook"><i class="fab fa-facebook text-2xl"></i></a>
                    <a href="https://www.whatsapp.com" target="_blank" class="hover:scale-110 transition-transform" title="WhatsApp"><i class="fab fa-whatsapp text-2xl"></i></a>
                </div>
            </div>

            <div>
                <h4 class="font-pagkaki text-[#A30F06] text-xl mb-6">Navegação</h4>
                <ul class="space-y-3 text-gray-500 font-medium uppercase text-xs tracking-widest">
                    <li><a href="<?php echo $prefix; ?>index.php" class="hover:text-[#A30F06] transition">Início</a></li>
                    <li><a href="<?php echo $prefix; ?>index.php#produtos" class="hover:text-[#A30F06] transition">Produtos</a></li>
                    <li><a href="<?php echo $prefix; ?>cliente/usuario.php" class="hover:text-[#A30F06] transition">Minha Conta</a></li>
                    <li><a href="<?php echo $prefix; ?>vendedor/vendedor.php" class="hover:text-[#A30F06] transition">Seja um Vendedor</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-pagkaki text-[#A30F06] text-xl mb-6">Atendimento</h4>
                <p class="text-gray-500 text-sm mb-4">
                    <i class="fas fa-envelope mr-2"></i> shopinn_<br>
                    <i class="fas fa-phone mr-2"></i> (88) 9 9735-33399
                </p>
                <div class="bg-[#E6DED3] p-4 rounded-lg inline-block">
                    <p class="text-[10px] font-black text-[#A30F06] uppercase">Segurança Certificada</p>
                    <div class="flex space-x-2 mt-2">
                        <i class="fas fa-shield-alt text-gray-400"></i>
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                </div>
            </div>

        </div>

        <div class="border-t border-gray-200 mt-12 pt-8 text-center">
            <p class="text-[10px] text-gray-400 uppercase tracking-widest italic">
                © 2024 SHOPIN A - O Marketplace do Nordeste. Todos os direitos reservados.
            </p>
        </div>
    </div>
</footer>