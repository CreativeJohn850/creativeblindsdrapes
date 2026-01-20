<?php
// Page-specific variables
$page_title = 'Custom Drapes & Curtains';
$meta_description = 'Browse our premium Adeko drape collections - Tuller and Fonluk. Over 125 elegant fabric options for custom sheers and draperies in Aurora, IL. Professional design and installation.';

// Load product data from JSON files
$tuller_json = file_get_contents('data/tuller.json');
$fonluk_json = file_get_contents('data/fonluk.json');

$tuller_products = json_decode($tuller_json, true);
$fonluk_products = json_decode($fonluk_json, true);

// Optional: Add basic error handling
if (json_last_error() !== JSON_ERROR_NONE || !is_array($tuller_products)) {
    $tuller_products = [];
    // You could log the error or show a message
}
if (json_last_error() !== JSON_ERROR_NONE || !is_array($fonluk_products)) {
    $fonluk_products = [];
}

// Include header
require_once 'includes/header.php';

function getPatternArrow($direction)
{
    $arrows = [
        'all' => '↔↕',
        'right' => '→',
        'left' => '←',
        'vertical'  => '↕',
        'horizontal' => '↔',
        'diagonal' => '↗↘',
        'up' => '↑',
        'down' => '↓'
    ];
    return $arrows[$direction] ?? '↔↕';
}
?>
<!-- Page Header -->
<section class="page-header"
    style="background: linear-gradient(135deg, var(--primary-teal) 0%, var(--primary-teal-dark) 100%); color: white; padding: 60px 20px; text-align: center;">
    <div class="container">
        <h1 style="color: white; margin-bottom: 15px;">Custom Sheer Curtains</h1>
        <p style="font-size: 1.2rem; color: rgba(255,255,255,0.95); max-width: 700px; margin: 0 auto;">Premium Adeko
            fabric collections from Turkey. Over 50 options for elegant sheer curtains options for your windows.</p>
    </div>
</section><!-- Collection Tabs & Products -->
<section style="padding: 60px 20px;">
    <div class="container">

        <!-- Search/Filter Bar -->
        <div style="margin-bottom: 40px; max-width: 600px; margin-left: auto; margin-right: auto;">
            <input type="text" id="productSearch" placeholder="Search products by name..."
                style="width: 100%; padding: 14px 20px; border: 2px solid var(--border-color); border-radius: 4px; font-size: 1rem; font-family: var(--font-primary);">
        </div>

        <!-- Tuller Tab Content -->
        <div class="tab-content active" id="tuller-content">
            <div class="products-grid"
                style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px;">
                <?php foreach ($tuller_products as $product): ?>
                    <div class="product-card" data-name="<?php echo strtolower($product['name']); ?>">
                        <div class="card-image" style="position: relative;">
                            <img src="assets/images/products/tuller/thumbnails/<?php echo strtolower($product['name']); ?>.webp"
                                alt="<?php echo htmlspecialchars($product['name']); ?> drape fabric"
                                onerror="this.src='images/placeholder-drape.jpg'">
                            <?php if (isset($product['face'])): ?>
                                <span
                                    style="position: absolute; top: 10px; right: 10px; background: var(--primary-teal); color: white; padding: 5px 12px; border-radius: 3px; font-size: 0.75rem; font-weight: 600;">
                                    <?php echo $product['face']; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="card-content">
                            <h3 style="font-size: 1.3rem; margin-bottom: 15px;">
                                <?php echo htmlspecialchars($product['name']); ?>
                            </h3>

                            <div class="product-specs"
                                style="font-size: 0.9rem; color: var(--text-gray); margin-bottom: 15px; line-height: 1.8;">
                                <div><strong>Weight:</strong>
                                    <?php echo $product['weight_us']; ?>
                                </div>
                                <div><strong>Composition:</strong>
                                    <?php echo $product['composition']; ?>
                                </div>
                                <div><strong>Width:</strong>
                                    <?php echo $product['width_us']; ?>
                                </div>
                                <div><strong>Lead Band:</strong>
                                    <?php echo $product['band'] === 'AVAILABLE' ? '✓ Available' : '✗ No'; ?>
                                </div>
                                <div><strong>Pattern:</strong>
                                    <?php echo getPatternArrow($product['pattern']); ?>
                                    <?php echo ucfirst($product['pattern']); ?>
                                </div>
                            </div>

                            <div style="display: flex; gap: 10px;">
                                <a href="assets/products/tuller/pdfs/<?php echo $product['name']; ?>.pdf"
                                    class="btn btn-primary"
                                    style="flex: 1; text-align: center; padding: 10px; font-size: 0.9rem;" download>
                                    📄 Download PDF
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>
<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Ready to Choose Your Perfect Fabric?</h2>
        <p>Schedule a free in-home consultation. We'll bring fabric samples directly to you!</p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-top: 30px;">
            <a href="contact.php#quote-form" class="btn btn-primary">Request Free Consultation</a>
            <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>" class="btn btn-secondary"
                style="background-color: transparent; color: white; border-color: white;">
                Call
                <?php echo BUSINESS_PHONE; ?>
            </a>
        </div>
    </div>
</section>
<script>
    // Tab switching
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            // Remove active from all tabs and buttons
            document.querySelectorAll('.tab-btn').forEach(b => {
                b.classList.remove('active');
                b.style.color = 'var(--text-gray)';
                b.style.borderBottomColor = 'transparent';
            });
            document.querySelectorAll('.tab-content').forEach(c => c.style.display = 'none');

            // Add active to clicked tab
            this.classList.add('active');
            this.style.color = 'var(--primary-teal)';
            this.style.borderBottomColor = 'var(--primary-teal)';

            const tabName = this.dataset.tab;
            document.getElementById(tabName + '-content').style.display = 'block';
        });
    });

    // Search functionality
    document.getElementById('productSearch').addEventListener('input', function (e) {
        const searchTerm = e.target.value.toLowerCase();
        const activeTab = document.querySelector('.tab-content.active') || document.querySelector('.tab-content[style*="display: block"]');
        const products = activeTab.querySelectorAll('.product-card');

        products.forEach(product => {
            const name = product.dataset.name;
            if (name.includes(searchTerm)) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    });
</script>
<?php
// Include footer
require_once 'includes/footer.php';
?>