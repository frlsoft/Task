<?php echo validation_errors();?>
<?php echo form_open('news/create');?>
<input type="input" name="title" value="<?php echo set_value('title')?>"/>
</br>
<textarea name="text"></textarea>
<input type="submit" name="submit" value="create" />
</form>