#!/usr/bin/env python3
"""
photo_util.py  generate _thumb.webp thumbnails for product gallery images.

For each target category under assets/images/products/<cat>/:
  - If the category has subdirectories, each subdir is treated as one product.
  - If the category has no subdirectories, the folder itself is the product.
In both cases the lexicographically first image is taken, scaled to
THUMB_HEIGHT px tall (aspect ratio preserved), and saved as
<original_stem>_thumb.webp in the same directory.

Usage:
    python photo_util.py           # skip already-generated thumbs
    python photo_util.py --force   # overwrite existing thumbs
"""

import sys
from pathlib import Path

try:
    from PIL import Image
except ImportError:
    print("Pillow is required: pip install Pillow", file=sys.stderr)
    sys.exit(1)

TARGET_CATEGORIES = [
    "centerpiece_roman",
    "honeycomb",
    "horizontal_blinds",
    "perfect_sheer",
    "shutters",
    "soluna_roller",
    "vertical_blinds",
]

IMAGE_EXTENSIONS = {".jpg", ".jpeg", ".png", ".webp"}
THUMB_HEIGHT = 400


def make_thumb(img_path: Path, force: bool = False) -> None:
    out_path = img_path.with_name(img_path.stem + "_thumb").with_suffix(".webp")

    if out_path.exists() and not force:
        print(f"  [skip]  {img_path.name}  (already exists)")
        return

    with Image.open(img_path) as img:
        w, h = img.size
        new_w = round(w * THUMB_HEIGHT / h)
        thumb = img.convert("RGB").resize((new_w, THUMB_HEIGHT), Image.LANCZOS)
        thumb.save(out_path, "WEBP", quality=85)

    print(f"  {img_path.name}  ->  {out_path.name}  ({new_w}x{THUMB_HEIGHT})")


def first_image(folder: Path) -> Path | None:
    candidates = sorted(
        f for f in folder.iterdir()
        if f.is_file() and f.suffix.lower() in IMAGE_EXTENSIONS
        and "_thumb" not in f.stem
    )
    return candidates[0] if candidates else None


def process_category(cat_path: Path, force: bool) -> None:
    subdirs = sorted(d for d in cat_path.iterdir() if d.is_dir())
    if subdirs:
        for subdir in subdirs:
            img = first_image(subdir)
            if img:
                make_thumb(img, force)
            else:
                print(f"  [warn]  {subdir.name}/   no images found")
    else:
        img = first_image(cat_path)
        if img:
            make_thumb(img, force)
        else:
            print(f"  [warn]  {cat_path.name}/   no images found")


def main() -> None:
    force = "--force" in sys.argv
    base = Path(__file__).parent / "assets" / "images" / "products"

    if not base.exists():
        print(f"ERROR: directory not found: {base}", file=sys.stderr)
        sys.exit(1)

    for cat_name in TARGET_CATEGORIES:
        cat_path = base / cat_name
        print(f"\n{cat_name}/")
        if not cat_path.is_dir():
            print(f"  [warn]  directory not found  skipping")
            continue
        process_category(cat_path, force)


if __name__ == "__main__":
    main()
