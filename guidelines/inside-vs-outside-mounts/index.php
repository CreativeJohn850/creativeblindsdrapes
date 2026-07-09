<?php
require_once dirname(__DIR__, 2) . '/includes/config.php';

$page_title       = "Inside vs Outside Mount Blinds Guide, Aurora IL";
$meta_description = "Understand inside mount vs outside mount window treatments for Aurora & Naperville homes. Expert guidance on blackout, light bleed, sill depth & style.";

$guide_h1    = "Inside vs. Outside Mounts for Aurora Windows";
$guide_path  = "/guidelines/inside-vs-outside-mounts/";
$guide_hero_image = "assets/images/carousel/curtain-drape-background-2365x594.jpg";
$guide_hero_image_mobile = "assets/images/carousel/curtain-drape-background-666x577.jpg";
$guide_intro = "Making the right mount choice for your architecture: how mount type affects light, blackout, the look of your window, and which one fits your sill depth.";

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Guides', 'path' => '/guidelines/'],
    ['name' => 'Inside vs. Outside Mounts'],
];

$s_intro = <<<'HTML'
<p>Mount type is one of the most consequential decisions in window treatment planning. It affects how much light enters the room, how large the window appears, whether the casing is showcased or concealed, and whether you can achieve a true blackout effect. Getting this decision right before you order prevents the second most common regret we hear from Aurora and Naperville homeowners, behind only choosing the wrong opacity level.</p>
HTML;

$s_means = <<<'HTML'
<h3>Inside mount</h3>
<p>An inside-mount treatment fits within the window casing, the frame surrounding the glass. The product is installed inside the opening, so the brackets attach to the top jamb or side jambs of the casing itself. The result is a clean, recessed look where the treatment sits flush with or slightly behind the face of the casing.</p>
<h3>Outside mount</h3>
<p>An outside-mount treatment is installed on the wall surface, the window casing face, or the window frame above the glass, so it overlaps the opening rather than sitting inside it. Brackets attach to the wall or face frame, and the treatment extends past the edges of the window on both sides and above the top of the frame.</p>
HTML;

$s_compare = <<<'HTML'
<div class="g-table-wrap"><table class="g-table">
<thead><tr><th>Factor</th><th>Inside Mount</th><th>Outside Mount</th></tr></thead>
<tbody>
<tr><td>Visual result</td><td>Recessed, minimalist, treatment disappears into the opening</td><td>Bold, wall-to-wall look, window appears taller and wider</td></tr>
<tr><td>Sill depth needed</td><td>Minimum 2.5 inches of clear depth (varies by product)</td><td>No depth requirement, brackets mount to wall or casing face</td></tr>
<tr><td>Light bleed</td><td>Peripheral light visible at frame edges when treatment is down</td><td>Minimal to none when mounted 2-4 inches beyond the frame</td></tr>
<tr><td>Blackout capability</td><td>Limited by the gap between treatment edge and frame</td><td>Superior, overlap eliminates all peripheral light paths</td></tr>
<tr><td>Showcases window trim</td><td>Yes, highlights existing moulding and casing detail</td><td>No, partially or fully conceals the frame and trim</td></tr>
<tr><td>Room appearance effect</td><td>Keeps scale accurate to the actual window size</td><td>Makes windows appear larger; raises perceived ceiling height</td></tr>
<tr><td>Suitable for</td><td>Deep sills, attractive woodwork, modern minimalist interiors</td><td>Shallow sills, plain frames, bedrooms requiring maximum darkness</td></tr>
</tbody>
</table></div>
HTML;

$s_inside = <<<'HTML'
<p>Inside mounting is the standard recommendation when a window has an attractive casing or moulding worth showcasing, a sill depth of at least 2.5 inches, and when the priority is a neat, architectural finish rather than maximum light elimination. Plantation shutters, wood blinds, and faux wood blinds all benefit from inside mounting because the structural treatment sitting inside the opening creates a furniture-grade appearance that outside mounting cannot replicate.</p>
<ul style="line-height: 1.9;">
<li><strong>Cellular / roller shades:</strong> minimum 2.5 inches of clear depth (no obstructions).</li>
<li><strong>Faux wood / wood blinds:</strong> minimum 3 inches (headrail depth).</li>
<li><strong>Plantation shutters:</strong> minimum 2.5 inches at the top jamb for a standard L-frame; 1.75 inches for a Z-frame.</li>
<li><strong>Custom drapery with inside rod:</strong> the rod pocket must clear any window crank hardware, verify before ordering.</li>
</ul>
HTML;

$s_outside = <<<'HTML'
<p>Outside mounting is the correct choice in four specific situations: when the sill depth is less than 2.5 inches, when the casing is damaged or visually unattractive, when you need the closest possible approach to full darkness, and when the goal is to create the illusion of a larger window in a smaller room.</p>
<h3>Achieving maximum blackout with outside mount</h3>
<p>Light bleed is the thin strip of light visible at the edges of a down treatment when the room is dark. It is the primary complaint from Aurora and Naperville homeowners who chose inside-mount room-darkening shades expecting full darkness. Outside mounting eliminates this problem by extending the treatment past the frame on all four sides.</p>
<div class="g-table-wrap"><table class="g-table">
<thead><tr><th>Dimension</th><th>Recommended Overhang</th><th>Purpose</th></tr></thead>
<tbody>
<tr><td>Width extension (each side)</td><td>2 to 4 inches beyond the frame</td><td>Eliminates side light bleed</td></tr>
<tr><td>Height extension (above frame)</td><td>4 to 6 inches above the top of the frame</td><td>Eliminates top light gap; raises apparent window height</td></tr>
<tr><td>Height extension (below frame)</td><td>Reach sill or floor depending on treatment type</td><td>Eliminates bottom gap; controls light path completely</td></tr>
</tbody>
</table></div>
<h3>Outside mount for larger-appearing windows</h3>
<p>Mounting a treatment 4 to 6 inches above the actual window frame and extending it 2 to 4 inches on each side makes the window appear substantially larger than it is. This is a standard design technique in Naperville new-builds where bedroom and living room windows are smaller than the homeowner would prefer. The treatment creates the visual impression of a window that fills the wall, even when the glass itself is modest.</p>
HTML;

$s_mixed = <<<'HTML'
<p>Many Aurora and Naperville homes benefit from mixed mount strategies: inside-mount shutters in living areas where aesthetics are the priority, and outside-mount room-darkening shades in bedrooms where blackout performance is critical. Creative Blinds & Drapes designers assess each room individually and recommend the mount type that serves both the functional and visual goals of the space.</p>
<p>Bay windows are a common mixed-mount scenario. The two flanking panels of a bay typically inside-mount well; the center panel, which is often the largest, sometimes requires outside mounting if it is shallower than the angles.</p>
HTML;

$guide_sections = [
    ['heading' => '', 'body' => $s_intro],
    ['heading' => 'What Each Mount Type Means', 'body' => $s_means],
    ['heading' => 'Side-by-Side Comparison', 'body' => $s_compare],
    ['heading' => 'When Inside Mount Is the Right Choice', 'body' => $s_inside],
    ['heading' => 'When Outside Mount Is the Right Choice', 'body' => $s_outside],
    ['heading' => 'Mixed Mount Situations', 'body' => $s_mixed],
];

$related_links = [
    ['url' => "/window-treatments/window-shutters/", 'label' => "Plantation shutters"],
    ['url' => "/window-treatments/window-blinds/", 'label' => "Wood and faux wood blinds"],
    ['url' => "/window-treatments/window-treatment-installer/", 'label' => "Professional measure and installation"],
    ['url' => "/guidelines/", 'label' => "All window treatment guides"],
];

$faqs = [
    ['q' => "Can I combine inside and outside mount treatments on the same window?",
     'a' => "Yes. A common combination is an inside-mount wood blind paired with an outside-mount drapery panel on each side. The blind provides privacy and light control; the drapes add softness and can be drawn fully closed over the blind for maximum light elimination. This layered window treatment approach is standard in formal living rooms and master bedrooms across Aurora and Naperville."],
    ['q' => "My sill is only 1.5 inches deep. Can I still get an inside-mount blind?",
     'a' => "At 1.5 inches, most inside-mount products cannot clear the casing without risking contact between the headrail and the window glass. Outside mounting is the recommended solution. For homeowners who prefer the look of an inside mount, a Z-frame shutter configuration is available for certain shutter products that bridges very shallow depths with a narrower mounting profile."],
    ['q' => "Does outside mount always look less polished than inside mount?",
     'a' => "Not when executed correctly. An outside-mount treatment with the right extension dimensions and the right hardware looks fully intentional and professionally finished. The visual issue with outside mounting usually comes from insufficient extension, a treatment hung too close to the frame that exposes casing and wall on both sides while providing no benefit. Our designers specify the correct dimensions for every outside-mount installation."],
];

$guide_cta_heading = "Not Sure Which Mount Suits Your Windows?";
$guide_cta_text    = "Our designer checks sill depth and design goals for every window and recommends the right mount. Book a free in-home consultation, no obligation.";

require ROOT_PATH . '/includes/guide-page.php';
