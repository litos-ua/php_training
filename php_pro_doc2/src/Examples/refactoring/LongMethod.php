<?php

namespace Doctor\PhpPro\Examples\refactoring;

class LongMethod
{
    // ....

    public static function prepare_receipt($printer)
    {
        if (self::hasItems($printer['id'])) {
            $output = '';

            if ($_POST['pre_receipt']) {
                $output .= "======== Pre receipt =======\n\n\n";
            }

            /**
             * Time and table
             */
            if ($_POST['isTakeaway'] || $_POST["isDeliveryGuys"] || $_POST["isBolt"]) {
                $output .= "Table: " . $_POST['table'] . "\n";
                $output .= "Floor: " . $_POST['floor'] . "\n";
                $output .= "Time: " . $_POST['takeawayTime'] . "\n";

                if ($_POST['order_comment']) {
                    $output .= "Comment: " . removeSpecialChars($_POST['order_comment']) . "\n";
                }
            } else {
                $output .= "Table: " . $_POST['table'] . "\n\n";
                $output .= "Floor: " . $_POST['floor'] . "\n\n";

                if ($_POST['order_comment']) {
                    $output .= "Comment: " . removeSpecialChars($_POST['order_comment']) . "\n";
                }
            }

            $output .= "------------------------\n";


            /**
             * Food items
             */
            foreach ($_POST['orderedItems'] as $orderedItem) {
                $has_unprinted_quantity = false;

                if (isset($orderedItem['last_printed_quantity'])) {
                    $unprinted_quantity_count = intval($orderedItem['is_printed_quantity']) - intval($orderedItem['last_printed_quantity']);

                    if ($unprinted_quantity_count > 0) {
                        $has_unprinted_quantity = true;
                    }
                }


                if (($orderedItem['should_print'] &&
                        !$orderedItem['is_printed'] &&
                        $orderedItem['is_visible']) ||
                    $_POST['pre_receipt'] ||
                    $has_unprinted_quantity) {
                    if (is_array($orderedItem['printers'])) {
                        $in_printer = in_array($printer['id'], $orderedItem['printers']);
                    } else {
                        $in_printer = in_array($printer['id'], json_decode($orderedItem['printers'], true));
                    }

                    if ($in_printer || $_POST['pre_receipt']) {
                        if ($orderedItem['is_sidedish'] && !$_POST['pre_receipt']) {
                            continue;
                        }

                        if ($has_unprinted_quantity) {
                            $output .= $unprinted_quantity_count . 'x ';
                        } else {
                            $output .= $orderedItem['quantity'] . 'x ';
                        }

                        // We ned to split it for multiple lines...
                        $itemDescriptionParts = self::split($orderedItem['description']);

                        foreach ($itemDescriptionParts as $itemDescription) {
                            $itemDescriptionClean = removeSpecialChars($itemDescription);
                            $output .= $itemDescriptionClean;
                        }

                        // Add price for pre receipt
                        if ($_POST['pre_receipt']) {
                            $output .= " - " . number_format($orderedItem['price_with_discount'], 2, '.', ',');
                        }

                        if (!$_POST['pre_receipt']) {
                            if ($orderedItem['comments'] != '') {
                                $output .= "   > " . removeSpecialChars(substr($orderedItem['comments'], 0, 27)) . "\n";
                            }
                        }

                        /** Side dishes */
                        if (isset($orderedItem['side_dishes']) && !$_POST['pre_receipt']) {
                            foreach ($orderedItem['side_dishes'] as $side_dish) {
                                $output .= "\n   + " . removeSpecialChars(substr($side_dish['description'], 0, 27)) . "\n";
                            }
                        }

                        $output .= "\n";
                    }
                }
            }

            /**
             * Sums
             */


            /**
             * Footer
             */
            $output .= "------------------------\n";

            if ($_POST['pre_receipt']) {
                $output .= "\nSubtotal: " . number_format($_POST['order']['subtotal'], 2, '.', ',') . "\n";
                $output .= "Discount: " . number_format($_POST['order']['discount'], 2, '.', ',') . "\n";
                $output .= "Total: " . number_format($_POST['order']['total'], 2, '.', ',') . "\n\n";
            }

            $output .= "Time: " . getTime() . "\n";

            return $output;
        } else {
            return 'EMPTY';
        }
    }

    // ....

}













class FixLongMethod
{
    //...
    protected static function createHeadline(): string
    {
        $border = str_repeat('=', 8);
        return $border . ' Pre receipt ' . $border . str_repeat(PHP_EOL, 3);
    }

    public static function prepareReceipt($printer)
    {
        $output = '';

        if (self::hasItems($printer['id'])) {
            $output .= self::createHeadline();
            $output .= self::createTimeTable($_POST);
            $output .= self::createSeparator();
            foreach ($_POST['orderedItems'] as $orderedItem) {
                $output .= self::createFoodItem($orderedItem, $_POST['pre_receipt']);
            }
            $output .= self::createSeparator();
            $output .= self::createFooter($_POST['order']);
        } else {
            $output = 'EMPTY';
        }
        return $output;
    }

    private static function createSeparator()
    {
        return str_repeat('-', 24) . PHP_EOL;
    }

    //...

}