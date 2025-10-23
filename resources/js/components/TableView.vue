<template>
    <div class="card">
        <div class="card-body border-bottom py-3">
            <slot name="headers"></slot>
        </div>
        <div class="table-responsive">
            <slot name="body"></slot>
        </div>
        <div class="card-footer">
            <slot name="footer"></slot>
        </div>
    </div>
</template>
