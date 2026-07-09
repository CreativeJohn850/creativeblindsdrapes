<?php
require_once dirname(__DIR__, 2) . '/includes/config.php';

$page_title       = "How to Prepare for Window Treatment Installation, IL";
$meta_description = "Step-by-step guide to preparing your Aurora or Naperville home for window treatment installation. Clear the workspace, remove old blinds, and more.";

$guide_h1    = "Preparing Your Home for Window Treatment Installation";
$guide_path  = "/guidelines/preparing-your-space/";
$guide_hero_image = "assets/images/carousel/curtain-drape-background-2365x594.jpg";
$guide_hero_image_mobile = "assets/images/carousel/curtain-drape-background-666x577.jpg";
$guide_intro = "Simple steps to get your home ready for the installation team, so the fitting is fast, safe, and leaves no risk to your furniture or decor.";

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Guides', 'path' => '/guidelines/'],
    ['name' => 'Preparing Your Space'],
];

$s_intro = <<<'HTML'
<p>A well-prepared room allows our installation team to work safely and efficiently, which means less time in your home and zero risk of accidental damage to your furniture or decor. The preparation steps in this guide take most homeowners fewer than 30 minutes per room, and completing them before we arrive is one of the most practical contributions you can make to a smooth installation day.</p>
HTML;

$s_week = <<<'HTML'
<h3>Remove existing window treatments</h3>
<p>Existing blinds, curtain rods, rings, clips, and any brackets still attached to the wall or casing should be removed before installation day. If you are unsure how to remove a particular mounting system, call our team at (630) 946-1406 and we will walk you through it. Leaving old brackets in place requires our installer to remove them first, adding time and creating the risk of wall patching that delays the installation.</p>
<h3>Check for wall or casing damage</h3>
<p>Old bracket holes, paint peeling near the window frame, or any water damage along the sill should be repaired and allowed to fully dry before installation. Patching compounds need at least 24 hours to cure before a bracket can be mounted over them. If damage is extensive, let our team know during the consultation and we will adjust the installation timeline accordingly.</p>
<h3>Note any window hardware conflicts</h3>
<p>Casement window cranks, tilt-in cleaning levers, cam-style locks, and bottom-rail pulls can conflict with certain headrail positions and operating mechanisms. Walk through each window and make a note of any hardware that protrudes into the casing or sill area, then share that information when we confirm the appointment. This allows our designer to verify clearances before the installation day rather than discovering a conflict on-site.</p>
HTML;

$s_day_before = <<<'HTML'
<ul style="line-height: 1.9;">
<li>Move furniture at least 3 feet back from each window to give the installer a clear path and space for a ladder.</li>
<li>Remove lamps, decorative objects, and plants from window sills and the immediate area around each window.</li>
<li>Take down artwork, mirrors, and wall hangings within 18 inches of each window on either side.</li>
<li>If a window is over a kitchen counter, bathtub, or other built-in surface, clear the surface completely so it can serve as a stable work platform.</li>
<li>If a wall-mounted TV is near a window being fitted, confirm the TV bracket hardware does not conflict with the planned mounting positions.</li>
</ul>
<p><strong>One task for the night before:</strong> wipe down the window frame and casing with a dry cloth. Dust and grease on the frame surface affect bracket adhesion on smooth casings and can cause a bracket to sit slightly out of level on the first attempt. Two minutes of preparation here makes a measurable difference in the speed and accuracy of the installation.</p>
HTML;

$s_install_day = <<<'HTML'
<h3>Confirm a point of contact</h3>
<p>One adult should be available in the home throughout the installation to answer questions, review progress, and approve any final adjustments before the team packs up. This is especially important in rooms where exact cord placement or shade height position needs to be confirmed with the homeowner present.</p>
<h3>Have your order confirmation available</h3>
<p>Keep a printed or digital copy of your Creative Blinds & Drapes order confirmation accessible on installation day. If any product detail needs to be cross-checked, a color, a fabric code, a specific lift system, having the confirmation on hand prevents delays.</p>
<h3>Children and pets</h3>
<p>Our installers use hand tools, power drills, and ladders throughout the installation. For safety, keep children and pets in a room away from the active work areas. Installation generates noise and occasional vibration through the wall, which can startle pets.</p>
<h3>Temperature and access</h3>
<p>Ensure all rooms being fitted are accessible, unlocked, and at a comfortable working temperature. Unusually cold rooms, those where the heating system is turned off and the window is the source of the cold, can affect how composite materials expand during installation.</p>
HTML;

$s_rooms = <<<'HTML'
<div class="g-table-wrap"><table class="g-table">
<thead><tr><th>Room Type</th><th>Extra Preparation Step</th><th>Why It Matters</th></tr></thead>
<tbody>
<tr><td>Kitchen</td><td>Clear the counter directly below the window; remove dish racks and small appliances</td><td>Counter serves as the work surface; objects at risk of tool contact</td></tr>
<tr><td>Bathroom</td><td>Remove toiletries and anything on the sill; clear the tub or vanity below</td><td>Limited space; tile surfaces require care with drill positioning</td></tr>
<tr><td>Children's bedroom</td><td>Remove soft toys piled against the window; secure the crib or bed away from the window</td><td>Cords and small parts require a clear, safe work zone</td></tr>
<tr><td>Home office</td><td>Move the desk chair and any monitor arms that extend toward the window area</td><td>Ladder positioning in small rooms needs clear floor space</td></tr>
<tr><td>Living room</td><td>Roll back any large rugs that extend under the window area</td><td>Ladder feet on rugs create instability on hardwood underneath</td></tr>
<tr><td>Master bedroom</td><td>Move nightstands and lamps away from windows beside the bed</td><td>Bracket drilling near the headboard requires full access to the casing</td></tr>
</tbody>
</table></div>
HTML;

$s_team = <<<'HTML'
<p>Creative Blinds & Drapes installers arrive with all required tools, fasteners, anchors, and hardware. You do not need to source anything separately. Our team also removes all packaging and disposes of it before leaving; every room is left clean and the treatment is fully operational before we pack up.</p>
<p>If the installation reveals a pre-existing condition that prevents safe bracket mounting, a hollow wall area without a stud, a casing that has rotated or split with age, or a lintel that is not level, we document it, discuss it with you, and agree on the correct solution before proceeding. We do not install over conditions that would compromise the long-term performance of the treatment.</p>
HTML;

$guide_sections = [
    ['heading' => '', 'body' => $s_intro],
    ['heading' => 'The Week Before: Planning and Removal', 'body' => $s_week],
    ['heading' => 'The Day Before: Room Setup', 'body' => $s_day_before],
    ['heading' => 'Installation Day: What to Have Ready', 'body' => $s_install_day],
    ['heading' => 'Room-Specific Preparation Notes', 'body' => $s_rooms],
    ['heading' => 'What the Team Takes Care Of', 'body' => $s_team],
];

$related_links = [
    ['url' => "/window-treatments/window-treatment-installer/", 'label' => "Professional installation service"],
    ['url' => "/window-treatments/motorized-window-treatment/", 'label' => "Motorized window treatments"],
    ['url' => "/contact/", 'label' => "Book your installation consultation"],
    ['url' => "/guidelines/", 'label' => "All window treatment guides"],
];

$faqs = [
    ['q' => "Do I need to be home during the entire installation?",
     'a' => "Yes. One adult should be present throughout. Creative Blinds & Drapes installers may need to confirm final cord length positions, shade stacking space, or the exact placement of a drapery rod bracket, and these decisions require input from the homeowner. Leaving the home during installation means those decisions cannot be made in real time and may need to be revisited."],
    ['q' => "What if I have not fully removed the old blinds before the team arrives?",
     'a' => "Our team can remove existing treatments as part of the installation, but this adds time to the appointment and may require rescheduling if removal reveals damaged casing or wall conditions that need repair before the new treatment can be mounted. Removing old treatments yourself before installation day is strongly recommended."],
    ['q' => "How long will the installation take?",
     'a' => "A standard residential installation covering four to six windows takes between two and four hours. Installations involving motorized shades, large drapery panels, or specialty shapes such as arched windows may take a full day. Creative Blinds & Drapes provides a time estimate specific to your project during the in-home consultation, so you can plan your schedule accordingly."],
];

$guide_cta_heading = "Ready for a Smooth Installation Day?";
$guide_cta_text    = "Book your free in-home consultation and we will confirm the timeline and any prep specific to your rooms. No obligation, samples brought to you.";

require ROOT_PATH . '/includes/guide-page.php';
