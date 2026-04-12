<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Document extends Model
{
    protected $table = 'documents';

    protected $primaryKey = 'document_id';

    protected $guarded = ['document_id'];

    public $timestamps = false;

    public function user()
    {
        return $this->hasOne('App\User', 'id','document_owner_user_id');
    }


    public static function get_document_tree_counts()
    {
        $document_tree_counts = array();
        $document_counts = Document::select(DB::raw(' COUNT(document_id) as document_count ,
  document_category ,  document_category_sub ,  document_category_sub_sub '))
            ->groupBy('document_category', 'document_category_sub', 'document_category_sub_sub')
            ->where('document_owner_user_id', auth()->user()->id)
            ->get();
        if ($document_counts) {
            $document_counts = $document_counts->toArray();
            foreach ($document_counts as $counts) {
                $document_tree_counts['total'] =
                    isset($document_tree_counts['total']) ? $document_tree_counts['total'] + $counts['document_count'] : $counts['document_count'];

                if ($counts['document_category'] > 0) {
                    $document_tree_counts['category'][$counts['document_category']] =
                        isset($document_tree_counts['category'][$counts['document_category']]) ?
                            $document_tree_counts['category'][$counts['document_category']] + $counts['document_count'] : $counts['document_count'];
                }

                if ($counts['document_category_sub'] > 0) {
                    $document_tree_counts['sub_category'][$counts['document_category_sub']] =
                        isset($document_tree_counts['sub_category'][$counts['document_category_sub']]) ?
                            $document_tree_counts['sub_category'][$counts['document_category_sub']] + $counts['document_count'] : $counts['document_count'];
                }

                if ($counts['document_category_sub_sub'] > 0) {
                    $document_tree_counts['sub_sub_category'][$counts['document_category_sub_sub']] =
                        isset($document_tree_counts['sub_sub_category'][$counts['document_category_sub_sub']]) ?
                            $document_tree_counts['sub_sub_category'][$counts['document_category_sub_sub']] + $counts['document_count'] : $counts['document_count'];
                }

            }
        }
        return $document_tree_counts;
    }


    public static function get_document_category_last_updated($user_id = false)
    {
        $document_category_last_updated = array();
        $document_updates = Document::select(DB::raw('MAX(document_updated) as document_updated , document_category'))
            ->groupBy('document_category')
            ->where('document_owner_user_id', auth()->user()->id)
            ->get();
        if ($document_updates) {
            foreach ($document_updates as $max_updated) {
                $document_category_last_updated[$max_updated->document_category] =
                    $max_updated->document_updated;
            }
        }
        return $document_category_last_updated;
    }

    public static function get_documents_by_category($document_category)
    {
        /*   $join = " LEFT JOIN categories ON categories.category_id = $this->table_name.document_category ";
           $join .= "LEFT JOIN categories_sub ON categories_sub.category_sub_id = $this->table_name.document_category_sub ";

           $conditions = array(
               'document_category' => $document_category,
               'document_owner_user_id' => $user_id
           );
           $order = " document_category ASC  , document_category_sub ASC  ";
           $where = $this->remove_false_condition_and_prepare_sub_query($conditions, ' AND ');
           $documents = array();
           $execution = $this->select($this->table_name, '*', $where, $order, $join, null);
           if ($execution && $this->numResults > 0) {
               $documents = $this->result;
           }*/

        return Document::leftJoin('categories', 'categories.category_id', '=', 'documents.document_category')
            ->leftJoin('categories_sub', 'categories_sub.category_sub_id', '=', 'documents.document_category_sub')
            ->where(['document_category' => $document_category,
                'document_owner_user_id' => auth()->user()->id])->get();
    }

    public static function get_documents_by_category_tree($document_category)
    {
        $documents = self::get_documents_by_category($document_category);
        $documents_category_tree = array();
        if ($documents) {
            foreach ($documents as $document) {
                $documents_category_tree[$document['document_category']][$document['document_category_sub']][] =
                    $document;
            }

        }
        return $documents_category_tree;
    }


    public static function get_documents_by_category_sub($document_category_sub)
    {
        /* $join = " LEFT JOIN categories ON categories.category_id = $this->table_name.document_category ";
         $join .= "LEFT JOIN categories_sub ON categories_sub.category_sub_id = $this->table_name.document_category_sub ";

         $conditions = array(
             'document_category_sub' => $document_category_sub,
             'document_owner_user_id' => auth()->user()->id
         );
         $order = " document_category ASC , document_category_sub ASC  , document_category_sub_sub ASC";
         $where = $this->remove_false_condition_and_prepare_sub_query($conditions, ' AND ');
         $documents = array();
         $execution = $this->select($this->table_name, '*', $where, $order, $join, null);
         if ($execution && $this->numResults > 0) {
             $documents = $this->result;
         }*/
        // return $documents;
        $conditions = array(
            'document_category_sub' => $document_category_sub,
            'document_owner_user_id' => auth()->user()->id
        );

        return Document::where($conditions)
            ->leftJoin('categories', 'categories.category_id', '=', 'documents.document_category')
            ->leftJoin('categories_sub', 'categories_sub.category_sub_id', '=', 'documents.document_category_sub')
            ->orderBy('document_category')
            ->orderBy('document_category_sub')
            ->orderBy('document_category_sub_sub')->get();

    }

    public static function get_document_counts_by_category_sub($document_category_sub){

        return count(self::get_documents_by_category_sub($document_category_sub));

    }

    public static function get_documents_by_category_sub_tree($document_category_sub)
    {
        $documents = self::get_documents_by_category_sub($document_category_sub);
        $documents_category_sub_tree = array();
        if ($documents) {
            foreach ($documents as $document) {
                $documents_category_sub_tree[$document->document_category][$document->document_category_sub]
                [$document->document_category_sub_sub][] =
                    $document->toArray();
            }

        }
        return $documents_category_sub_tree;
    }

}
