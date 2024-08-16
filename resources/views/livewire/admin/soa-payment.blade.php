<div>
    <x-button label="Add Payment" slate wire:click="$set('payment_modal', true)" rounded class="font-semibold"
        icon="cash" />

    <x-modal wire:model.defer="payment_modal" z-index="40" align="center" max-width="2xl">
        <x-card title="PAYMENT TRANSACTION">
            <div>
                {{ $this->form }}
            </div>


        </x-card>
    </x-modal>
</div>
