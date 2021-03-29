<?php declare(strict_types=1);


namespace App\Presenters;

use App\Components\BusinessCardControl;
use App\Model\BusinessCardManager;
use Nette\ComponentModel\IComponent;


final class HomepagePresenter extends BasePresenter
{
	protected BusinessCardManager $businessCardManager;

	public function __construct(BusinessCardManager $businessCardManager)
	{
		parent::__construct($businessCardManager);
		$this->businessCardManager = $businessCardManager;
	}

	public function startup()
	{
		parent::startup();
	}

	public function renderDefault(): void
	{
		$this->template->userBusinessCards = $this->businessCardManager->getRows([BusinessCardManager::COLUMN_USERS_ID => $this->user->getId()]);
	}

	public function handleNewBusinessCard(): void
	{
		$this->redirect('BusinessCard:New');
	}

	public function handleEditBusinessCard($id): void
	{
		$this->redirect('BusinessCard:edit', ['id' => $id]);
	}

	public function handleDeleteBusinessCard($id): void
	{
		$this->businessCardManager->delete($id);
		$this->flashMessage('Vizitka smazána');
		$this->redirect('this');
	}

	public function createComponentBusinessCard(): IComponent
	{
		$control = new BusinessCardControl();

		return $control;
	}
}
