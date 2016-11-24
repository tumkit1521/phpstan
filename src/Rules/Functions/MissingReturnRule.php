<?php declare(strict_types = 1);

namespace PHPStan\Rules\Functions;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\FunctionMissingReturnCheck;

class MissingReturnRule implements \PHPStan\Rules\Rule
{

	/** @var \PHPStan\Rules\FunctionMissingReturnCheck */
	private $missingReturnCheck;

	public function __construct(FunctionMissingReturnCheck $missingReturnCheck)
	{
		$this->missingReturnCheck = $missingReturnCheck;
	}

	public function getNodeType(): string
	{
		return Node\Stmt\Function_::class;
	}

	/**
	 * @param \PhpParser\Node\Stmt\Function_ $node
	 * @param \PHPStan\Analyser\Scope $scope
	 * @return string[]
	 */
	public function processNode(Node $node, Scope $scope): array
	{
		if (
			$node->getReturnType() === null
			|| $node->getStmts() === null
		) {
			return [];
		}

		return $this->missingReturnCheck->checkMissingReturn(
			$node,
			sprintf(
				'Anonymous function should return %s but empty return statement found.',
				$node->getReturnType()
			)
		);
	}

}
