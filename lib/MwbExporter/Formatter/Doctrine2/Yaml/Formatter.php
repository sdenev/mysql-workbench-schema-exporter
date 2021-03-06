<?php

/*
 * The MIT License
 *
 * Copyright (c) 2010 Johannes Mueller <circus2(at)web.de>
 * Copyright (c) 2012 Toha <tohenk@yahoo.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace MwbExporter\Formatter\Doctrine2\Yaml;

use MwbExporter\Formatter as BaseFormatter;
use MwbExporter\Model\Base;

class Formatter extends BaseFormatter
{
    const CFG_BUNDLE_NAMESPACE             = 'bundleNamespace';
    const CFG_ENTITY_NAMESPACE             = 'entityNamespace';
    const CFG_REPOSITORY_NAMESPACE         = 'repositoryNamespace';
    const CFG_AUTOMATIC_REPOSITORY         = 'useAutomaticRepository';
    const CFG_EXTEND_TABLENAME_WITH_SCHEMA = 'extendTableNameWithSchemaName';

    protected function init()
    {
        $this->setDatatypeConverter(new DatatypeConverter());
        $this->addConfigurations(array(
            static::CFG_INDENTATION                   => 4,
            static::CFG_FILENAME                      => '%entity%.orm.%extension%',
            static::CFG_BUNDLE_NAMESPACE              => '',
            static::CFG_ENTITY_NAMESPACE              => '',
            static::CFG_REPOSITORY_NAMESPACE          => '',
            static::CFG_EXTEND_TABLENAME_WITH_SCHEMA  => false,
            static::CFG_AUTOMATIC_REPOSITORY          => true,
        ));
    }

    /**
     * (non-PHPdoc)
     * @see MwbExporter.Formatter::createTable()
     */
    public function createTable(Base $parent, $node)
    {
        return new Model\Table($parent, $node);
    }

    /**
     * (non-PHPdoc)
     * @see MwbExporter.FormatterInterface::createColumns()
     */
    public function createColumns(Base $parent, $node)
    {
        return new Model\Columns($parent, $node);
    }

    /**
     * (non-PHPdoc)
     * @see MwbExporter.FormatterInterface::createColumn()
     */
    public function createColumn(Base $parent, $node)
    {
        return new Model\Column($parent, $node);
    }

    /**
     * (non-PHPdoc)
     * @see MwbExporter.FormatterInterface::createIndex()
     */
    public function createIndex(Base $parent, $node)
    {
        return new Model\Index($parent, $node);
    }

    /**
     * (non-PHPdoc)
     * @see MwbExporter.Formatter::createForeignKey()
     */
    public function createForeignKey(Base $parent, $node)
    {
        return new Model\ForeignKey($parent, $node);
    }

    public function getTitle()
    {
        return 'Doctrine 2.0 YAML';
    }

    public function getFileExtension()
    {
        return 'yml';
    }
}