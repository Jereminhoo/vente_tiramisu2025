<?php
function displayFooter() {
    ?>
        </div> <!-- Fermeture du container -->
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>À propos</h3>
                    <p>Tiramisu - Votre boutique de tiramisus artisanaux</p>
                </div>
                <div class="footer-section">
                    <h3>Contact</h3>
                    <p>Email: contact@tiramisu.fr</p>
                    <p>Téléphone: 01 23 45 67 89</p>
                </div>
                <div class="footer-section">
                    <h3>Suivez-nous</h3>
                    <div class="social-links">
                        <a href="#">Facebook</a>
                        <a href="#">Instagram</a>
                        <a href="#">Twitter</a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> Tiramisu. Tous droits réservés.</p>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    <?php
}
?> 