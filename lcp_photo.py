#!/usr/bin/env python3
"""
lcp_photo.py — Generate mobile-optimised hero images for LCP improvement.

For each source file, produces a _m.webp sibling in the same directory:
  - Resized to fit within 768 × 600 px (maintains aspect ratio, no upscale)
  - WebP quality 78 (good visual fidelity, ~80-95 % smaller than raw JPEGs)

Usage:
    python lcp_photo.py path/to/image1.jpg path/to/image2.jpg ...
"""
import sys
from pathlib import Path
from PIL import Image

MOBILE_MAX_W = 768
MOBILE_MAX_H = 600
WEBP_QUALITY = 78


def make_mobile(src: Path) -> Path:
    dst = src.with_name(src.stem + "_m.webp")
    with Image.open(src) as img:
        img = img.convert("RGB")
        # thumbnail() shrinks in-place to fit the box, never upscales
        img.thumbnail((MOBILE_MAX_W, MOBILE_MAX_H), Image.LANCZOS)
        img.save(dst, "WEBP", quality=WEBP_QUALITY, method=6)
    kb_src = src.stat().st_size // 1024
    kb_dst = dst.stat().st_size // 1024
    saving = round((1 - kb_dst / kb_src) * 100)
    print(f"  {src.name:<50}  {kb_src:>6} KB  ->  {dst.name:<55}  {kb_dst:>4} KB  ({saving}% smaller)")
    return dst


def main():
    if len(sys.argv) < 2:
        print("Usage: python lcp_photo.py <image1> [image2 ...]")
        sys.exit(1)

    print(f"\n{'Source':<52}  {'Before':>8}       {'Output':<57}  {'After':>6}\n" + "-" * 140)
    errors = 0
    for arg in sys.argv[1:]:
        src = Path(arg)
        if not src.exists():
            print(f"  SKIP (not found): {arg}")
            errors += 1
            continue
        try:
            make_mobile(src)
        except Exception as e:
            print(f"  ERROR {src.name}: {e}")
            errors += 1

    sys.exit(errors)


if __name__ == "__main__":
    main()
