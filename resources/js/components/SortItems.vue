<template>
    <div class="flex gap-2 items-center">
        <label for="sort">
            <b for="sort">urutkan :</b>
        </label>
        <select name="sort" class="text-sm rounded-md">
            <option value="paling sesuai">Paling Sesuai</option>
            <option value="latest">Terbaru</option>
            <option value="max_price">Harga Tertinggi</option>
            <option value="min_price">Harga Terendah</option>
        </select>
    </div>
</template>

<script>
export default {};
</script>

<style></style>
