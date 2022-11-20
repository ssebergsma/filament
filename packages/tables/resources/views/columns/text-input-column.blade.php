<div
    x-data="{ error: undefined }"
    {{
        $attributes
            ->merge($getExtraAttributes(), escape: false)
            ->class(['filament-tables-text-input-column'])
    }}
>
    <input
        value="{{ $getState() }}"
        type="{{ $getType() }}"
        @disabled($isDisabled())
        @if ($inputMode = $getInputMode()) inputmode="{{ $inputMode }}" @endif
        @if ($placeholder = $getPlaceholder()) placeholder="{{ $placeholder }}" @endif
        @if ($interval = $getStep()) step="{{ $interval }}" @endif
        x-on:change="
            response = await $wire.setColumnValue(@js($getName()), @js($recordKey), $event.target.value)
            error = response?.error ?? undefined
        "
        x-tooltip="error"
        x-bind:class="{
            'border-gray-300 dark:border-gray-600': ! error,
            'border-danger-600 ring-1 ring-inset ring-danger-600 dark:border-danger-400 dark:ring-danger-400': error,
        }"
        {{
            $attributes
                ->merge($getExtraAttributes(), escape: false)
                ->merge($getExtraInputAttributes(), escape: false)
                ->class([
                    'ml-0.5 text-gray-900 inline-block transition duration-75 rounded-lg shadow-sm focus:ring-primary-500 focus:ring-1 focus:ring-inset focus:border-primary-500 disabled:opacity-70 dark:bg-gray-700 dark:text-white dark:focus:border-primary-500',
                    match ($getAlignment()) {
                        'center' => 'text-center',
                        'right' => 'text-right',
                        default => 'text-left',
                    },
                ])
        }}
        wire:loading.attr="readonly"
    />
</div>
