<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;
use WvnderlabAgency\CopyrightHeader\CopyrightHeaderFixer;

$finder = Finder::create()
    ->in(getcwd())
    ->name('*.php')
    ->exclude([
        'bootstrap/cache',
        'node_modules',
        'resources',
        'storage',
        'tests',
        'vendor'
    ])
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new Config())
    ->registerCustomFixers([
        'WvnderlabAgency/copyright_header' => new CopyrightHeaderFixer()
    ])
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setRules([
        // ------------------------------------------------------------------------
        // Preset
        // ------------------------------------------------------------------------
        '@PSR12' => true,

        // ------------------------------------------------------------------------
        // Copyright Header
        // ------------------------------------------------------------------------
        'WvnderlabAgency/copyright_header' => true,

        // ------------------------------------------------------------------------
        // Arrays & Collections
        // ------------------------------------------------------------------------
        'array_push' => true,
        'array_syntax' => ['syntax' => 'short'],
        'list_syntax' => ['syntax' => 'short'],
        'normalize_index_brace' => true,
        'trim_array_spaces' => true,
        'whitespace_after_comma_in_array' => true,
        'no_whitespace_before_comma_in_array' => true,
        'no_trailing_comma_in_singleline' => true,
        'trailing_comma_in_multiline' => true,

        // ------------------------------------------------------------------------
        // Operators
        // ------------------------------------------------------------------------
        'binary_operator_spaces' => ['default' => 'single_space'],
        'concat_space' => ['spacing' => 'one'],
        'not_operator_with_successor_space' => false,
        'object_operator_without_whitespace' => true,
        'space_after_semicolon' => false,
        'unary_operator_spaces' => true,

        // ------------------------------------------------------------------------
        // Comments
        // ------------------------------------------------------------------------
        'align_multiline_comment' => true,
        'single_line_comment_style' => ['comment_types' => ['asterisk']],
        'no_empty_comment' => false,
        'no_empty_phpdoc' => true,
        'no_trailing_whitespace_in_comment' => true,

        // ------------------------------------------------------------------------
        // PHP Doc Blocks
        // ------------------------------------------------------------------------
        'phpdoc_align' => ['align' => 'left'],
        'phpdoc_indent' => true,
        'phpdoc_inline_tag_normalizer' => true,
        'phpdoc_no_access' => true,
        'phpdoc_no_empty_return' => true,
        'phpdoc_no_package' => true,
        'phpdoc_no_useless_inheritdoc' => true,
        'phpdoc_order' => [
            'order' => [
                'author', 'copyright', 'license', 'category', 'package',
                'subpackage', 'deprecated', 'since', 'extends', 'mixin', 'use',
                'uses', 'property', 'property-read', 'property-write', 'method',
                'param', 'return', 'throws', 'type', 'var', 'link', 'see',
            ],
        ],
        'phpdoc_scalar' => true,
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_summary' => true,
        'phpdoc_trim' => true,
        'phpdoc_types' => true,
        'phpdoc_var_annotation_correct_order' => true,
        'phpdoc_var_without_name' => true,

        // ------------------------------------------------------------------------
        // Casing & Naming
        // ------------------------------------------------------------------------
        'class_reference_name_casing' => true,
        'constant_case' => ['case' => 'lower'],
        'integer_literal_case' => true,
        'lowercase_cast' => true,
        'lowercase_keywords' => true,
        'lowercase_static_reference' => true,
        'magic_constant_casing' => true,
        'magic_method_casing' => true,
        'native_function_casing' => true,
        'native_type_declaration_casing' => true,

        // ------------------------------------------------------------------------
        // Whitespace & Formatting
        // ------------------------------------------------------------------------
        'blank_line_after_namespace' => true,
        'blank_line_after_opening_tag' => false,
        'blank_line_before_statement' => ['statements' => ['continue', 'break', 'return']],
        'blank_line_between_import_groups' => false,
        'blank_lines_before_namespace' => true,
        'no_extra_blank_lines' => ['tokens' => ['extra', 'throw', 'use', 'use_trait']],
        'no_trailing_whitespace' => true,
        'no_whitespace_in_blank_line' => true,
        'single_blank_line_at_eof' => true,
        'statement_indentation' => true,

        // ------------------------------------------------------------------------
        // Classes, Methods & Properties
        // ------------------------------------------------------------------------
        'class_attributes_separation' => ['elements' => ['method' => 'one']],
        'class_definition' => true,
        'ordered_class_elements' => [
            'order' => ['case', 'constant', 'use_trait', 'property', 'construct', 'destruct', 'magic', 'method'],
        ],
        'visibility_required' => ['elements' => ['property', 'method']],
        'single_class_element_per_statement' => true,
        'single_trait_insert_per_statement' => true,
        'protected_to_private' => false,
        'static_private_method' => false,

        // ------------------------------------------------------------------------
        // Braces & Control Structures
        // ------------------------------------------------------------------------
        'braces_position' => [
            'control_structures_opening_brace' => 'same_line',
            'functions_opening_brace' => 'next_line_unless_newline_at_signature_end',
            'anonymous_functions_opening_brace' => 'same_line',
            'classes_opening_brace' => 'next_line_unless_newline_at_signature_end',
            'anonymous_classes_opening_brace' => 'next_line_unless_newline_at_signature_end',
            'allow_single_line_empty_anonymous_classes' => false,
            'allow_single_line_anonymous_functions' => false,
        ],
        'control_structure_braces' => true,
        'elseif' => true,
        'no_unneeded_braces' => true,
        'no_unneeded_control_parentheses' => true,
        'no_unreachable_default_argument_value' => true,

        // ------------------------------------------------------------------------
        // Functions & Methods
        // ------------------------------------------------------------------------
        'function_declaration' => true,
        'function_typehint_space' => true,
        'method_argument_space' => [
            'on_multiline' => 'ensure_fully_multiline',
            'keep_multiple_spaces_after_comma' => false,
        ],
        'method_chaining_indentation' => true,
        'return_type_declaration' => ['space_before' => 'none'],

        // ------------------------------------------------------------------------
        // Strings & Literals
        // ------------------------------------------------------------------------
        'explicit_string_variable' => true,
        'heredoc_to_nowdoc' => true,
        'single_quote' => true,
        'simple_to_complex_string_variable' => true,

        // ------------------------------------------------------------------------
        // Control Flow & Operators
        // ------------------------------------------------------------------------
        'simplified_if_return' => true,
        'simplified_null_return' => true,
        'switch_case_semicolon_to_colon' => true,
        'switch_case_space' => true,
        'switch_continue_to_break' => true,
        'ternary_operator_spaces' => true,
        'ternary_to_null_coalescing' => true,

        // ------------------------------------------------------------------------
        // Namespaces & Imports
        // ------------------------------------------------------------------------
        'ordered_imports' => [
            'sort_algorithm' => 'alpha',
            'imports_order' => ['class', 'function', 'const'],
        ],
        'no_unused_imports' => true,
        'no_leading_import_slash' => true,
        'no_leading_namespace_whitespace' => true,
        'clean_namespace' => true,

        // ------------------------------------------------------------------------
        // Cleaning & Optimization
        // ------------------------------------------------------------------------
        'combine_consecutive_issets' => true,
        'combine_consecutive_unsets' => true,
        'compact_nullable_type_declaration' => true,
        'no_unset_cast' => true,
        'no_useless_return' => true,
        'lambda_not_used_import' => true,
        'no_unneeded_import_alias' => true,
        'set_type_to_cast' => false,
        'regular_callable_call' => false,

        // ------------------------------------------------------------------------
        // Diverse & Specials
        // ------------------------------------------------------------------------
        'declare_equal_normalize' => true,
        'declare_parentheses' => true,
        'declare_strict_types' => true,
        'encoding' => true,
        'full_opening_tag' => true,
        'include' => true,
        'increment_style' => ['style' => 'post'],
        'indentation_type' => true,
        'psr_autoloading' => false,
        'random_api_migration' => false,
        'return_assignment' => false,
        'self_accessor' => false,
        'self_static_accessor' => true,
        'semicolon_after_instruction' => true,
        'short_scalar_cast' => true,
        'single_import_per_statement' => true,
        'single_line_after_imports' => true,
        'single_line_empty_body' => true,
        'single_line_throw' => true,
        'yoda_style' => false,
        'no_multiline_whitespace_around_double_arrow' => true,
        'no_space_around_double_colon' => true,
        'no_spaces_around_offset' => ['positions' => ['inside', 'outside']],
        'no_spaces_after_function_name' => true,
        'no_closing_tag' => true,
        'no_empty_statement' => true,
    ]);
