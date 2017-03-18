<?php
/**
 * Sample php server script for a wookmark integration
 *
 * @author Sebastian Helzle <sebastian@helzle.net>
 */

/**
 * Basic class which provides all functions to retrieve and paginate pictures
 */
class picture {

  /**
   * @var array $data
   */
  protected $data;

  /**
   * @var int $itemsPerPage
   */
  protected $itemsPerPage;

  function __construct($data, $itemsPerPage) {
    $this->data = $data;
    $this->itemsPerPage = $itemsPerPage;
  }

  /**
   * Returns the pictures of the given page or an empty array if page doesn't exist
   * @param int $page
   * @return array
   */
  public function getPage($page=1) {
    if ($page > 0 && $page <= $this->getNumberOfPages()) {
      $startOffset = ($page - 1) * $this->itemsPerPage;
      return array_slice($this->data, $startOffset, $this->itemsPerPage);
    }
    return array();
  }

  /**
   * Returns the maximum number of pages
   * @return int
   */
  public function getNumberOfPages() {
    return ceil(count($this->data) / $this->itemsPerPage);
  }
}