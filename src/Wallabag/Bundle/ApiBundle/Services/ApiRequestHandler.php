<?php

namespace 

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

class ApiRequestHandler {

	private $em;

	public function __construct(EntityManager $entityManager) {
		$this->em = $entityManager;
	}

	public function entries(Request $request) {


		$archive = (bool) $request->get('archive', false);
		$star = (bool) $request->get('star', false);
		$delete = (bool) $request->get('delete', false);
		$p_sort = $request->get('sort', 'created');

		if( $p_sort == 'created' || $p_sort == 'updated' ) {
			$sort = $p_sort;
		} else {
			// throw new WrongParameterException ?
		}

		$p_order = $request->get('order', 'desc');

		if( $p_order == 'asc' || $p_order == 'desc' ) {
			$order = $p_order;
		} else {
			// ?
		}

		$p_page = $request->get('page', 1);

		if( !is_integer($p_page) || $p_page < 0 ) {
			$page = 1;
		} else {
			$page = (int) $p_page;
		}

		$p_per_page = $request->get('per_page', 30);

		if( !is_integer($p_per_page) || $p_per_page < 0 ) {
			$per_page = 30;
		} else {
			$per_page = min(100, (int) $p_per_page);
		}

		// tags comma separed
		$tags = explode(',', $request->get('tags', ''));

		$repository = $this->em
			->getRepository('WallabagCoreBundle:Entry');

		$entries = $repository->findBy(
				array(
					'archive'=>$archive, 
					'star'=>$star,
					'delete'=>$delete,
				),
				array($sort=>$order),
				$per_page,
				$per_page * $page
			);

		return $entries;

	}

}