<div>
    <x-button label="Add Payment" dark wire:click="$set('payment_modal', true)" />

    <x-modal wire:model.defer="payment_modal" align="center">
        <x-card title="Consent Terms">
            <div>
                {{ $this->form }}
            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="I Agree" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
