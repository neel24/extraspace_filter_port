<?php
/**
 * @file
 * Tests for Extraspace module.
 * Work in progress.
 */

namespace Drupal\Tests\extraspace_filter\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Ensure that the extraspace filter functions properly.
 *
 * @group filter
 */
class ExtraspaceFilterTest extends BrowserTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  protected static $modules = ['extraspace_filter', 'node'];

  /**
   * The default theme.
   *
   * @var string
   */
  protected $defaultTheme = 'stark';

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();

    $this->drupalCreateContentType(['type' => 'page', 'name' => 'Page']);
  }

  /**
   * {@inheritdoc}
   */
  public function testExtraspaceFilterCreate() {

    $assert_session = $this->assertSession();
    $page = $this->getSession()->getPage();

    // Create and log in our privileged user.
    $this->drupalLogin($this->drupalCreateUser(['create page content']));

    // Create node to edit.
    $this->drupalGet('node/add/page');
    $page->fillField('title[0][value]', 'My test node title');
    $page->fillField('body[0][value]', 'My test node body');
    $page->pressButton('Save');
    $assert_session->pageTextContains('Page My test node title has been created');
  }

}
